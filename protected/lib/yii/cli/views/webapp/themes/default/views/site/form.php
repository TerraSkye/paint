<?php
/* @var $this SiteController */
/* @var $form CActiveForm */
$form=$this->beginWidget('CActiveForm', array(
	'id'=>'common-widgets-form',
	'enableAjaxValidation'=>true,
	'enableClientValidation'=>true,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

<?php $this->widget('common.widgets.form.FAddress', array('form' => $form)); ?>
	
	<div class="row buttons">
		<?php echo CHtml::submitButton('Submit'); ?>
	</div>

<?php $this->endWidget(); ?>
