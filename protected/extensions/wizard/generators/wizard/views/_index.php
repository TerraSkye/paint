<?php

?>
<h1>Wizard Generator</h1>

<p>This generator generates an action,view and a model</p>

<?php $form = $this->beginWidget('CCodeForm', array('model' => $model)); ?>


<div class="row">
	<?php echo $form->labelEx($model, 'modelAttributes'); ?>
	<?php echo $form->textArea($model, 'modelAttributes', array('rows' => 3,'class' => 'span6')); ?>
	<div class="tooltip">
			The attribues u would like to have in the model/view
	</div>
	<?php echo $form->error($model, 'modelAttributes'); ?>
</div>



<div class="row">
	<?php echo $form->labelEx($model, 'view'); ?>
	<?php echo $form->textField($model, 'view', array('size' => 65)); ?>
	<div class="tooltip">

	</div>
	<?php echo $form->error($model, 'view'); ?>
</div>
<div class="row">
	<?php echo $form->labelEx($model, 'model'); ?>
	<?php echo $form->textField($model, 'model', array('size' => 65)); ?>
	<div class="tooltip">

	</div>
	<?php echo $form->error($model, 'model'); ?>
</div>
<div class="row sticky">
	<?php echo $form->labelEx($model, 'baseModelClass'); ?>
	<?php echo $form->textField($model, 'baseModelClass', array('size' => 65)); ?>
	<div class="tooltip">

	</div>
	<?php echo $form->error($model, 'baseModelClass'); ?>
</div>
<div class="row">
	<?php echo $form->labelEx($model, 'action'); ?>
	<?php echo $form->textField($model, 'action', array('size' => 65)); ?>
	<div class="tooltip">

	</div>
	<?php echo $form->error($model, 'action'); ?>
</div>
<div class="row sticky">
	<?php echo $form->labelEx($model, 'baseActionClass'); ?>
	<?php echo $form->textField($model, 'baseActionClass', array('size' => 65)); ?>
	<div class="tooltip">

	</div>
	<?php echo $form->error($model, 'baseActionClass'); ?>
</div>

<?php $this->endWidget(); ?>
