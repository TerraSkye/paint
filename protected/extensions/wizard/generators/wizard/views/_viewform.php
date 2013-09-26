<div class="portlet">
	<div class="portlet-decoration">
		<div class="portlet-title">Wizard form</div>
	</div>
</div>


<div class="row">
	<?php echo $form->labelEx($model, 'view'); ?>
	<?php echo $form->textField($model, 'view', array('size' => 65)); ?>
	<div class="tooltip">

	</div>
	<?php echo $form->error($model, 'view'); ?>
</div>

