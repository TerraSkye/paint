<div class="section-divider"></div>
<?php echo CHtml::link(Yii::t('text', 'Annuleren'),$url !== null ? $url : Yii::app()->createUrl($action === null ? '' : $action,!isset($params)  ? array() : $params), 	array('class' => 'btn')); ?>
<?php echo CHtml::submitButton(Yii::t('text', 'Opslaan'), array('class' => 'btn btn-submit')); ?>
<div class="clearfix"></div>