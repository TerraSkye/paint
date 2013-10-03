
<div class="registration-form">

    <?php $form = $this->beginWidget('application.widgets.bootstrap.TbActiveForm', array(
        'id' => 'credit-create-transaction-form',
        'type' => 'horizontal',
        'enableAjaxValidation' => false,
        'action' => $this->createUrl($action->id),
    )); ?>

    <div class="section-header">
    Activiteiten
        </div>



<?php foreach(Activity::model()->findAll() as $activity):?>
    <?php $this->widget('common.widgets.bootstrap.TbControlGroup', array(
    	'model' => $model,
    	'label' => $activity->value,
    	'items' => array(
    		"activity[{$activity->primaryKey}]" => array(
    			'type' => TbControlGroup::TEXT_FIELD,
    			'htmlOptions' => array(
    				'class' => 'span3',
    			)
    		),
    	)
    )); ?>
    <?php endforeach;?>

    <?php $this->renderPartial('wizardControls') ?>
    <?php $this->endWidget();?>


