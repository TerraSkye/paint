<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Sjoerd
 * Date: 26-9-13
 * Time: 11:41
 * To change this template use File | Settings | File Templates.
 */

class CWizardEnqueteSummary extends CWizardModelAction
{


	private $_log;


	public function finalize()
	{
		$transaction = Yii::app()->db->beginTransaction();
		try {
			$contact = new Contact();
			$contact->setAttributes($this->log['contact']->attributes);
			$contact->knowledge_base = $this->log['basic']->test;

			if ($contact->save()) {
				foreach ($this->log as $model) {
					if ($model instanceof BasicForm) {
						foreach ($model->question as $question_id => $answer) {
							if ($answer == -1) {
								$option = Option::newModel();
								$option->setAttributes(array(
									'question_id' => $question_id,
									'source_id' => 2,
									'value' => $model->option[$question_id],
								));
								$option->saveWithChecks();
							} else {
								$option = Option::model()->findByPk($answer);
							}
							$contactAnswer = ContactQuestion::model();
							$contactAnswer->setAttributes(array(
								'contact_id' => $contact->contact_id,
								'question_id' => $question_id,
								'option_id' => $option->option_id,
							));
							$contactAnswer->saveWithChecks();
						}
					}
					if($model instanceof ActivityForm){
						foreach ($model->activity as $activity_id => $quantity){
							$contactActivity = ContactActivity::newModel();
							$contactActivity->setAttributes(array(
								'contact_id' => $contact->contact_id,
								'amount' => $quantity,
								'question_id' => $activity_id,
							));
							$contactActivity->saveWithChecks();
						}
					}
					if($model instanceof ArtistForm){
						foreach ($model->artist as $artist_id => $score){
							$contactActivity = ContactArtist::newModel();
							$contactActivity->setAttributes(array(
								'contact_id' => $contact->contact_id,
								'weight' => $score,
								'artist_id' => $artist_id,
							));
							$contactActivity->saveWithChecks();
						}
					}

					if($model instanceof RankingForm){
						$i = 1;
						foreach ($model->ranking as $painting => $o){

							$contactPainting = ContactPainting::newModel();
							$contactPainting->setAttributes(array(
								'contact_id' => $contact->contact_id,
								'weight' => $i,
								'painting_id' => $painting,
							));
							$contactPainting->saveWithChecks();
                            $i++;
						}
					}

					if($model instanceof EmailForm){

						$contact->email = $model->emailAdress;
						$contact->save();
					}

				}
			} else {
				throw new CException("could not save contact");
			}

			$transaction->commit();
		} catch (Exception $e) {
			$transaction->rollback();
			throw $e;
		}
      $this->controller->redirect(array('index'));
	}


	/**
	 * Builds and/or retrieves the wizard's log.
	 * @return array
	 */
	public function getLog()
	{
		if ($this->_log !== null)
			return $this->_log;
		$actions = $this->controller->actions();
		$models = array();
		$logs = CWizardLog::model()->forSession($this->controller->session)->findAll();
		foreach ($logs as $log) {
			if (isset($actions[$log->action_id]['model'])) {
				$class = $actions[$log->action_id]['model'];
				$scenario = 'insert';
				if (($offset = strpos($class, '('))) {
					$scenario = substr($class, $offset + 1, strpos($class, ')') - $offset - 1);
					$class = substr($class, 0, $offset);
				}
				if (!empty($log->data)) {
					$models[$log->action_id] = new $class($scenario);
					$models[$log->action_id]->attributes = $log->data;
				}
			}
		}
		$this->_log = $models;
		return $models;
	}
}