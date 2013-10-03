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

    <?php $this->widget('common.widgets.bootstrap.TbControlGroup', array(
        'model' => $model,
        'items' => array(
            'date_of_birth' => array(
                'type' => TbControlGroup::DATE_DROP_DOWN,
                'typeOptions' => array(
                    'data' => array(
                        'd' => XHtml::getDayData(),
                        'm' => XHtml::getMonthData(),
                        'Y' => XHtml::getYearData(),
                    ),
                ),
                'htmlOptions' => array(
                    'd' => array('class' => 'span2'),
                    'm' => array('class' => 'span3'),
                    'Y' => array('class' => 'span3')
                ),
            )
        )
    )); ?>


    <?php $this->widget('common.widgets.bootstrap.TbControlGroup', array(
        'model' => $model,
        'items' => array(
            "education_id" => array(
                'type' => TbControlGroup::RADIO_BUTTON,
                'typeOptions' => array(
                    'data' =>    CHtml::listData(Education::model()->findAll(),'education_id','value')
                ),
                'htmlOptions' => array(
                    'radioClass' => 'radio',
                    'uncheckValue' => null,
                )
            ),
        )
    )); ?>

    <?php ?>

    <?php $this->renderPartial('wizardControls') ?>
    <?php $this->endWidget();?>



</div>

