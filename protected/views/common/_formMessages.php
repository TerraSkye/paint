<?php /**
 * @var $this CController
 * @var $form TbActiveForm
 * @var $model XFormModel
 *
 */ ?>

<?php $this->widget('common.widgets.bootstrap.TbAlert', array('alerts' => 'success')); ?>

<?php // Multiple models ?>
<?php if(isset($models)): ?>
	<?php if(YII_DEBUG):?>
	<?php echo CHtml::errorSummary($models,'DEBUG MODE  [errors]',null,array('class' => 'alert alert-info'));?>
	<?php endif;?>
	<?php foreach($models as $model): ?>
		<?php if($model->hasErrors()): ?>
			<div class="alert alert-error">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<?php echo Yii::t('text', 'Ho! Er gaat iets fout'); ?>
			</div>
			<?php break; ?>
		<?php endif; ?>
	<?php endforeach; ?>
<?php elseif (!isset($models) && isset($model)&& $model->hasErrors()): ?>
	<?php if(YII_DEBUG):?>
		<?php echo CHtml::errorSummary($model,'DEBUG MODE  [errors]',null,array('class' => 'alert alert-info'));?>
	<?php endif;?>
	<div class="alert alert-error">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		<?php echo Yii::t('text', 'Ho! Er gaat iets fout!'); ?>
		<?php if (isset($required) && $required !== false): ?>
			<ul>
				<li><?php echo Yii::t('text', 'Velden met een * zijn verplicht.'); ?></li>
			</ul>
		<?php endif; ?>
	</div>
<?php endif; ?>