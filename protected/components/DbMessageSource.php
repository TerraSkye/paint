<?php

class DbMessageSource extends CDbMessageSource
{

	/**
	 * @var array
	 */
	private static $allowedCategories = array(
		// Yii core
		'yii',
		'zii',
		'coreMessage',
		'message',
		// Our categories
		'header',
		'menu',
		'url',
		'message',
		'model',
		'text',
	);

	public function __construct()
	{

	}

	/**
	 * @param $category
	 * @param $message
	 * @param null $language
	 * @return string
	 * @throws CException
	 */
	public function translate($category, $message, $language = null)
	{

        return $message;
		if (is_object($category)) {
		//	$name = $category->id;
			if ($category instanceof CModel) {
				$name = get_class($category).'.model';
			} else if ($category instanceof CController) {
				$name = $category->id.'.text';
			} else {
				$name = "text";
			}
			$category = $name;
		}


		if (substr($category, 0, 2) != '//')
			$category = $this->completeCategory($category);
		else
			$category = substr($category, 2, strlen($category) - 2);

		$this->attachEventHandler('onMissingTranslation', array($this, 'missingTranslation'));
		if (!is_numeric($message))
			$ret = parent::translate($category, $message, $language);
		else
			$ret = $message;
		$this->detachEventHandler('onMissingTranslation', array($this, 'missingTranslation'));
		return $ret;
	}

	protected function completeCategory($category)
	{
		return Yii::app()->params['siteType'] . '.' . Yii::app()->params['label'] . '.' . $category;
	}

	/* reverse translation is not trivial as you see! */
	public function storeTranslation($category, $source, $message, $language = null)
	{
		$category = $this->completeCategory($category);
		if (is_null($language))
			$language = Yii::app()->language;

		$transaction = $this->dbConnection->beginTransaction();

		$id = $this->dbConnection->createCommand()->
			select('source_message_id')->from($this->sourceMessageTable)->
			where('category = :category and message = :message',
			array(':category' => $category, ':message' => $source))->
			queryScalar();

		if (!$id) {
			$this->dbConnection->createCommand()->
				insert($this->sourceMessageTable,
				array(
					'category' => $category, 'message' => $source,
					'create_date' => new CDbExpression('NOW()'),
				)
			);
			$id = $this->dbConnection->lastInsertId;
		}

		$yii_message_id = $this->dbConnection->createCommand()->
			select('message_id')->from($this->translatedMessageTable)->
			where('source_message_id = :id and language = :language', array(':id' => $id, ':language' => $language))->
			queryScalar();

		if (!$yii_message_id) {
			echo 'storing new';
			$this->dbConnection->createCommand()->
				insert($this->translatedMessageTable,
				array(
					'source_message_id' => $id,
					'language' => $language,
					'translation' => $message,
					'create_date' => new CDbExpression('SYSUTCDATETIME()'),
				)
			);
		} else {
			$this->dbConnection->createCommand()->
				update($this->translatedMessageTable, array('translation' => $message,),
				'message_id = :message_id', array(':message_id' => $yii_message_id,)
			);
		}
		$transaction->commit();
		$this->resetCache($category, $language, $source);
	}

	public function resetCache($category, $language, $message)
	{
		Yii::app()->cache->delete('translation.default.indb.' . md5($category . '.' . $message));
		Yii::app()->cache->delete(self::CACHE_KEY_PREFIX . '.messages.' . $category . '.' . $language);
	}

	/**
	 * @param $category
	 * @return bool
	 */
	private function isValidCategory($category)
	{
		$explodedCategory = explode(".", $category);
		return in_array($explodedCategory[count($explodedCategory) - 1], self::$allowedCategories);
	}

	public function missingTranslation(CMissingTranslationEvent $event)
	{
		$splittedCategory = explode(".", $event->category);
		if (count($splittedCategory) === 3) {
			$splittedCategory[3] = $splittedCategory[2];
			$splittedCategory[2] = '';
		}
		list($siteType, $label, $component, $category) = $splittedCategory;

		$cacheId = 'translation.default.indb.' . md5($event->category . '.' . $event->message);
		$cache = Yii::app()->getCache();

		if (!$cache or $cache->get($cacheId) === false) {
			$sourceMessage = YiiSourceMessage::newModel()->findByAttributes(array(
				'category' => $event->category,
				'message' => $event->message
			));
			if ($sourceMessage === null) {
				$sourceMessage = YiiSourceMessage::newModel();
				$sourceMessage->category = $event->category;
				$sourceMessage->message = $event->message;
				if (!$sourceMessage->save())
					throw new Exception("Default source message could not be saved, errors: " . serialize($sourceMessage->getErrors()));
			}
			if ($cache)
				$cache->set($cacheId, true, Yii::app()->params['defaultCacheTime']);
		}
		$event->handled = true;
	}

	/**
	 * Loads the messages from database.
	 * You may override this method to customize the message storage in the database.
	 * @param string $category the message category
	 * @param string $language the target language
	 * @return array the messages loaded from database
	 * @since 1.1.5
	 */
	protected function loadMessagesFromDb($category, $language)
	{
		$sql = <<<EOD
SELECT t1.message AS message, t2.translation AS translation
FROM {$this->sourceMessageTable} t1, {$this->translatedMessageTable} t2
WHERE t1.source_message_id=t2.message_id AND t1.category=:category AND t2.language=:language
EOD;
		$command = $this->getDbConnection()->createCommand($sql);
		$command->bindValue(':category', $category);
		$command->bindValue(':language', $language);
		$messages = array();
		foreach ($command->queryAll() as $row)
			$messages[$row['message']] = $row['translation'];

		return $messages;
	}


}