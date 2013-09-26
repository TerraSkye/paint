<h1>Wizard Generator</h1>

<p>This generator generates an action,view and a model</p>

<?php $form = $this->beginWidget('CCodeForm', array('model' => $model)); ?>

<div class="portlet">
	<div class="portlet-decoration">
		<div class="portlet-title">Attributes</div>
	</div>
</div>
<div class="row">
	<?php echo $form->labelEx($model, 'formAttributes'); ?>
	<?php echo $form->textArea($model, 'formAttributes', array('rows' => 3, 'style' => 'width:417px;')); ?>
	<div class="tooltip">
		a list of attributes
	</div>
	<?php echo $form->error($model, 'formAttributes'); ?>
</div>

<div class="portlet">
	<div class="portlet-decoration">
		<div class="portlet-title">View Path</div>
	</div>
</div>
<div class="row">
	<?php echo $form->labelEx($model,'controller'); ?>
	<?php echo $form->textField($model,'controller',array('size'=>65)); ?>
	<div class="tooltip">

	</div>
	<?php echo $form->error($model,'controller'); ?>
</div>

<?php $this->endWidget(); ?>