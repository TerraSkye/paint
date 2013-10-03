
<div class="registration-form">

    <?php $form = $this->beginWidget('application.widgets.bootstrap.TbActiveForm', array(
        'id' => 'credit-create-transaction-form',
        'type' => 'horizontal',
        'enableAjaxValidation' => false,
        'action' => $this->createUrl($action->id),
    )); ?>

  
<?php foreach(Artist::model()->findAll() as $artist):?>


    <?php $this->widget('common.widgets.bootstrap.TbControlGroup', array(
    	'model' => $model,
    	'label' => $artist->value,
    	'items' => array(
    		"artist[{$artist->primaryKey}]" => array(
    			'type' => TbControlGroup::RADIO_BUTTON,
                'typeOptions' => array(
                    'data' => $model->scale,
                ),
                'htmlOptions' => array(
                    'uncheckValue' => null,
                )

    		),
    	)
    )); ?>
    <?php endforeach;?>

    <?php $this->renderPartial('wizardControls') ?>
    <?php $this->endWidget();?>


