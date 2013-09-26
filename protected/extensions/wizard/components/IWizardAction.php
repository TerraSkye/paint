<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Sjoerd
 * Date: 16-8-12
 * Time: 8:20
 *
 * Edited by Bart on 13-9-2012
 */
interface IWizardAction extends IAction {
	/* the jobs of a wizard */
	public function post();
	public function validate();
	public function finalize();
	/* accessors */
	public function getNextAction($actions);
	public function getPreviousAction($actions);
	public function getData();
	public function setData(array $data);
}
