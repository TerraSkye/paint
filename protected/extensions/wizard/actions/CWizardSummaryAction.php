<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Sjoerd
 * Date: 16-8-12
 * Time: 8:22
 * To change this template use File | Settings | File Templates.
 */
/**
 * @property CWizardController $controller
 * @property Website $website
 *
 */
class CWizardSummaryAction extends CWizardAction
{
	public $view = 'summary';
	public $models;

	private $_website;



	public function init()
	{
		$actions = $this->controller->actions();
		$models = array();
		$logs =CWizardLog::model()->forSession($this->controller->session)->findAll();
		if(empty($logs)){
			$this->controller->redirect($this->controller->getInitial());
		}
		foreach ($logs as $log) {
			if (isset($actions[$log->action_id]['model'])) {
				$class = $actions[$log->action_id]['model'];
				$scenario = 'insert';
				if (($offset = strpos($class, '('))) {
					$scenario = substr($class, $offset + 1, strpos($class, ')') - $offset - 1);
					$class = substr($class, 0, $offset);
				}

				$models[$log->action_id] = new $class($scenario);
				$models[$log->action_id]->attributes = $log->data;
			}
		}
		$this->models = $models;
	}

	public function post()
	{
		//method stub
	}

	public function finalize()
	{
		//save all the models here.
	}

	public function run()
	{
		$this->init();
		$this->controller->render($this->view, array('log' => $this->models, 'action' => $this));
	}

	public function validate()
	{
		$this->init();
		$bool = true;
		foreach ($this->models as $model) {
			if (!$model->validate())
				$bool = false;
		}
		return $bool;
	}


	protected function save()
	{
		foreach (func_get_args() as $model) {
			if (!$model->save())
				throw new CDbException('could not save [' . get_class($model) . ' ] with error :' . json_encode($model->errors));
		}
		return true;
	}

	/**
	 * @param $service
	 * @param Contact $contact
	 */
	protected function saveService($service, Contact $contact = null)
	{
		if ($contact === null && !Yii::app()->user->isGuest !== null)
			$contact = Yii::app()->user->model();
		if (!ContactService::newModel()->findByAttributes(array(
			'contact_id' => $contact->contact_id,
			'service_id' => $service))
		)
			ContactService::newModel()->saveWithAttributes(array(
				'contact_id' => $contact->contact_id,
				'service_id' => $service));
	}

	protected function resolve(&$model, $attributes)
	{


		$class = get_class($model);
		if (!($record = $class::model()->findByAttributes($attributes))) {
			$this->save($model);
		} else {
			$model = $record;
		}
	}

	protected function getWebsite(){
		if($this->_website === null){
			$this->_website =Website::model()->findByAttributes(array('name' => Yii::app()->params['websiteName']));
			if($this->_website === null){
				throw new CException("A website needs to be configured");
			}
		}
		return $this->_website;
	}

}
