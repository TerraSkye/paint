<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Sjoerd
 * Date: 3-10-13
 * Time: 12:51
 * To change this template use File | Settings | File Templates.
 */
?>


<div class="registration-form">


    <?php
    /* @var $form TbActiveForm */
    $form = $this->beginWidget('application.widgets.bootstrap.TbActiveForm', array(
        'id' => 'credit-create-transaction-form',
        'type' => 'horizontal',
        'enableAjaxValidation' => false,
        'action' => $this->createUrl($action->id),
    )); ?>

    <div class="section-header"><?php echo Yii::t('header', 'Persoonsgegevens'); ?></div>

    <?php $this->widget('common.widgets.bootstrap.TbControlGroup', array(
        'model' => $model,
        'htmlOptions' => array('class' => 'registration-row',),
        'items' => array(
            'is_female' => array(
                'type' => TbControlGroup::RADIO_BUTTON,
                'typeOptions' => array(
                    'data' => $model->genderOptions,
                ),
            ),
        )
    )); ?>


</div>