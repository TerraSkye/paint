<?php if ($model->hasErrors()): ?>
	<div class="alert alert-error">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		<?php echo Yii::t('text', 'Ho! Er gaat iets fout'); ?>
	</div>
<?php endif; ?>