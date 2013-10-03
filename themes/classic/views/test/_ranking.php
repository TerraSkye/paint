
    <div class="registration-form">

        <?php
        /* @var $form TbActiveForm*/
         $form = $this->beginWidget('application.widgets.bootstrap.TbActiveForm', array(
            'id' => 'credit-create-transaction-form',
            'type' => 'horizontal',
            'enableAjaxValidation' => false,
            'action' => $this->createUrl($action->id),
        )); ?>



        <?php
        $this->widget('common.widgets.bootstrap.TbControlGroup', array(
            'model' => $model,
            'label' =>false,
            'items' => array(
                TbControlGroup::FREE_TEXT => array(
                    'typeOptions' => array(
                        'encodeHtml' => FALSE,
                        'content' => "Natuurlijk bestaat er niet zoiets als ‘de gemiddelde Nederlander’.
                Maar als u uzelf vergelijkt met wat andere mensen van kunst weten,
                in hoeverre bent u dan onder gemiddeld of bovengemiddeld?"
                    )
                )
            )
        ));
        ?>



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
            TbControlGroup::FREE_TEXT => array(
                'typeOptions' => array(
                    'encodeHtml' => FALSE,
                    'content' => "Veel"
                ),
                'htmlOptions' => array(
                    'class' => 'radio inline',
                ),
            )
    	)
    )); ?>



        <?php $this->widget('common.widgets.bootstrap.TbControlGroup', array(
        	'model' => $model,
        	'label' => Yii::t('text',$model->question),
        	'items' => array(
        		"question[{$model->question->primaryKey}]" => array(
        			'type' => TbControlGroup::RADIO_BUTTON,
                    'typeOptions' => array(
                        'data' => CMap::mergeArray(
                            CHtml::listData($model->question->options,'option_id','value'),array(
                                "0" => $form->textField($model,"question[{$model->question->primaryKey}]")
                            )),
                    ),
        			'htmlOptions' => array(
        				'radioClass' => 'radio',
                        'uncheckValue' => null,
        			)
        		),
        	)
        )); ?>

        <?php $this->widget('common.widgets.bootstrap.TbControlGroup', array(
            'model' => $model,
            'label' => Yii::t('text',$model->question2),
            'items' => array(
                "question[{$model->question2->primaryKey}]" => array(
                    'type' => TbControlGroup::RADIO_BUTTON,
                    'typeOptions' => array(
                        'data' =>    CHtml::listData($model->question2->options,'option_id','value')
                    ),
                    'htmlOptions' => array(
                        'radioClass' => 'radio',
                        'uncheckValue' => null,
                    )
                ),
            )
        )); ?>



        <?php $this->renderPartial('wizardControls') ?>
     <?php $this->endWidget();?>


