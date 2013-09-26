<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Sjoerd
 * Date: 5-9-13
 * Time: 16:47
 * To change this template use File | Settings | File Templates.
 */
?>

<div class="row-fluid">
	<div class="span4">
		<?php echo Yii::t('text', 'Naam'); ?>
	</div>
	<div class="span8">
		<?php echo CHtml::encode($this->contact->given_name . ' ' . $this->contact->surname_prefix . ' ' . $this->contact->surname); ?>
	</div>
</div>


