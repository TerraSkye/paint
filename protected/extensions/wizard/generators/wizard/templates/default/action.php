<?php
/**
 * @var $this WizardCode
 */
?>

<?php echo "<?php\n"; ?>
/**
* Created by JetBrains PhpStorm.
* User: Sjoerd
* Date: <?php echo date('Y-m-d')."\n" ?>
*
*/

class  CWizard<?php echo ucfirst($this->action)  ?> extends <?php echo strpos($this->baseActionClass,'.') ?substr($this->baseActionClass,strrpos($this->baseActionClass,'.')+1) : $this->baseActionClass ?>
{



		public function run(){
		//TODO method stub
			parent::run();
		};


}
