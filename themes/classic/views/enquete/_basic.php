<div class="registration-form">


    <?php
    /* @var $form TbActiveForm */
    $form = $this->beginWidget('application.widgets.bootstrap.TbActiveForm', array(
        'id' => 'credit-create-transaction-form',
        'type' => 'horizontal',
        'enableAjaxValidation' => false,
        'action' => $this->createUrl($action->id),
    )); ?>

    <div class="section-header">
        Inleiding
    </div>
    <p>
        Van harte welkom bij deze vragenlijst, die is opgezet door onderzoekers van Hanzehogeschool Groningen, met de
        bedoeling meer te weten te komen over waarom mensen wel of niet van kunst houden. In totaal zal het invullen van
        deze vragenlijst ongeveer tien minuten duren. We hebben ons best gedaan het voor u ook leuk te maken om aan het
        onderzoek deel te nemen: we zullen u bijvoorbeeld een aantal kunstwerken laten zien, zodat u aan de hand daarvan
        kunt aangeven wat u wel, of juist niet mooi vindt.
        Graag willen we u vragen om het invullen van de vragenlijst in één keer helemaal af te maken, en om tijdens het
        invullen geen andere vensters open te zetten in uw browser. Dit onderzoek gaat over uw smaak in kunst. U kunt
        dus geen ‘verkeerde’ antwoorden geven, want over smaak valt immers niet te twisten!

        Dank u wel voor uw deelname!
    </p>

    <div class="section-header">
        Basis vragen
    </div>


    <?php $this->widget('application.widgets.bootstrap.TbControlGroup', array(
        'model' => $model,
        'items' => array(
            'test' => array(
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

    <div class="section-divider"></div>

    <?php $this->widget('common.widgets.bootstrap.TbControlGroup', array(
        'model' => $model,
        'label' => Yii::t('text', $model->questionData[0]),
        'items' => array(
            "question[{$model->questionData[0]->primaryKey}]" => array(
                'type' => TbControlGroup::RADIO_BUTTON,
                'typeOptions' => array(
                    'data' => CMap::mergeArray(
                        CHtml::listData($model->questionData[0]->options, 'option_id', 'value'), array(
                        "-1" => "</label>" . $form->textField($model, "question[{$model->questionData[0]->primaryKey}]",
								array(
									'name' => "BasicForm[option][{$model->questionData[0]->primaryKey}]",
									'value' => isset($model->option[1]) ? $model->option[1] : '',
									'placeholder' => 'Anders namelijk'))
                        . "<label>",
                    )),
                ),
                'htmlOptions' => array(
                    'radioClass' => '',
                    'uncheckValue' => null,
                )
            ),
        )
    )); ?>
    <div class="section-divider"></div>
    <?php $this->widget('common.widgets.bootstrap.TbControlGroup', array(
        'model' => $model,
        'label' => Yii::t('text', $model->questionData[1]),
        'items' => array(
            "question[{$model->questionData[1]->primaryKey}]" => array(
                'type' => TbControlGroup::RADIO_BUTTON,
                'typeOptions' => array(
                    'data' => CMap::mergeArray(
                        CHtml::listData($model->questionData[1]->options, 'option_id', 'value'), array(
                        "-1" => "</label>" . $form->textField($model, "question[{$model->questionData[1]->primaryKey}]", array(
								'name' => "BasicForm[option][{$model->questionData[1]->primaryKey}]",
								'value' => isset($model->option[2]) ? $model->option[2] : '',
								'style' => 'float:left',
								'placeholder' => 'Anders namelijk'
							)) . "<label>"
                    )),
                ),
                'htmlOptions' => array(
                    'radioClass' => '',
                    'uncheckValue' => null,
                )
            ),
        )
    )); ?>

    <?php $this->renderPartial('wizardControls') ?>
    <?php $this->endWidget(); ?>




<?php Yii::app()->clientScript->registerScript('select-radio-1', '$("#BasicForm_option_1").on("click",function(){ $("#BasicForm_question_1_-1").prop("checked",true)})') ?>
<?php Yii::app()->clientScript->registerScript('select-radio-2', '$("#BasicForm_option_2").on("click",function(){ $("#BasicForm_question_2_-1").prop("checked",true)})') ?>