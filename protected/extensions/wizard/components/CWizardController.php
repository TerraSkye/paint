<?php

/**
 * @property Cmap $wizardMap
 * @property CwizardSession $session
 * @property IWizardAction $action
 * */

class CWizardController extends CommonController
{
	protected $session;

	public $defaultAction = 'index';
	public $wizardForm;

	public function init()
	{
        Yii::log("initializing wizard controller", CLogger::LEVEL_INFO, 'extensions.CWizard');
		if (sizeof($this->actions()) > 0) {
			$this->session = $this->getSession();
		}

	}

	public function actionIndex()
	{
		Yii::app()->session->remove("wizard-{$this->uniqueId}");
		$this->session = $this->getSession();
		$this->forward($this->getInitial());
	}

	/**
	 * @param IWizardAction $action
	 */
	public function runAction($action)
	{
		if ($action instanceof IWizardAction) {
            $this->setAction($action);
			if (Yii::app()->request->isPostRequest) {
				$action->post(Yii::app()->getRequest());
				if ($action->validate()) {
					if (!$action->finalize()) {
						throw new CWizardException('could not finalze method :' . $action->id, $action->id);
					}
					$log = new CWizardLog;
					$log->add($action);
					$next = $action->getNextAction(new CMap($this->actions()));
					$action = $this->createActionFromMap($this->actions(), $next, $next);
					$state = $this->retrieveState($action);
					if (!is_null($state))
						$action->data = $state->data;
					$this->setAction($action);
				}
			} else { /* GET request, try to return the state from the log */
				$state = $this->retrieveState($action);
				if (!is_null($state)) {
					$action->data = $state->data;
				} else if ($action->id !== $this->getInitial()) {
					$this->redirect($this->createUrl($this->getInitial()));
				}
			}
            Yii::log(json_encode($action->data), CLogger::LEVEL_INFO, 'extensions.CWizard');
			$action->run();
		} else {
			parent::runAction($action);
		}
	}

	/**
	 * @return CWizardSession
	 */
	public function getSession()
	{
		$session = CWizardSession::model()->
			findByAttributes(array('session_id' => Yii::app()->session->get("wizard-{$this->uniqueId}", null)
		));
		if (!isset($session) or is_null($session)) {
			Yii::app()->session->add("wizard-{$this->uniqueId}", $id = uniqid());
			$session = new CWizardSession();
			$session->session_id = $id;
			$session->ip = $_SERVER['REMOTE_ADDR'];
			$session->wizard_id = $this->id;
			$session->save();
			$session->refresh();
		}
		return $session;
	}

	/**
	 * Drops the current wizard session so a new one can be generated
	 */
	public function dropSession()
	{

		Yii::app()->session->remove("wizard-{$this->uniqueId}");
	}

	/**
	 * @param IWizardAction
	 * @return CWizardLog
	 * @throws CException
	 */
	public function addState(IWizardAction $action)
	{
		$log = new CWizardLog();
		$log->wizard_session_id = $this->session->wizard_session_id;
		$log->action_id = $action->getId();
		$log->data = $action->getData();
		$log->next_action_id = $action->getNextAction(new CMap($this->actions));
		if ($log->save())
			return $log;
	}

	/**
	 * @param IWizardAction $action
	 * @return CWizardLog
	 */
	public function retrieveState(IWizardAction $action)
	{
		return CWizardLog::model()
			->forSession($this->session)
			->byAction($action)->find();
	}

	public function finalize()
	{
		foreach ($this->session->logs() as $logs) {
			$action = $this->createAction($logs->action_id);
			if (($data = $this->retrieveState($action)) !== null)
				$action->data = $data->data;
			$action->finalize();
		}
	}

	/**
	 * This returns an array of log models by their action.
	 * It contains the latest log entries in a given session.
	 *
	 * @return array
	 */
	public function getLog()
	{
		$models = CWizardLog::model()->forSession($this->session)->findAll();
		for ($log = array(); list(, $model) = each($models);
		     $log[$model->action_id] = $model) ;
		if (!count($log))
			$log = array(new CWizardLog);
		return $log;
	}

	/**
	 * Return the initial action of the wizard map
	 */
	public function getInitial()
	{

		return key($this->actions());
	}

	/**
	 * History is written by winners
	 */
	public function getHistory()
	{
		$log = $this->getLog();
		$history = array($this->initial);
		/* if our log is empty (or incorrect), then we cannot walk it at all */
		if (!isset($log[$this->initial]))
			return $history;
		$next = $log[$this->initial]->next_action_id;
		/* log always has the latest entry,
			 so build it walking to the next item,
			 starting from the initial step */
		while (!is_null($next)) {
			$history[] = $next;
			if (isset($log[$next])) {
				$next = $log[$next]->next_action_id;
			} else {
				break;
			}
		}
		return $history;
	}

	/**
	 * Get the menu itmes
	 */
	public function getMenuItems()
	{
		$items = array();
		foreach ($this->history as $action) {
			$items[] = array('label' => ucfirst($action),
				'url' => array($action,
					'session_id' => $this->session->session_id));
		}
		return $items;
	}



	public function render($view, $data = array(), $return = false)
	{
		return parent::render($view, CMap::mergeArray(array('action' => $this->action), $data), $return);
	}

	public function renderPartial($view,  $data = array(), $return = false, $processOutput = false)
	{
		return	parent::renderPartial($view, CMap::mergeArray(array('action' => $this->action), $data), $return, $processOutput);
	}



}

