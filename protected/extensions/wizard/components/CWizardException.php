<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Sjoerd
 * Date: 16-8-12
 * Time: 8:20
 * To change this template use File | Settings | File Templates.
 */
class CWizardException extends CException {
	public $action;
	public $data;
	public function __construct($msg, $action, $data = null) {
		$this->message = $msg;
		$this->action = $action;
		$this->data = $data;
	}
}