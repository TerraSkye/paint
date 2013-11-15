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

	<div class="section-header">
		Bedankt!
	</div>
	<p>
		Hartelijk dank voor uw medewerking aan dit onderzoek. U bent de <?php echo count(Contact::model()->findAll())+1 ?>
		de respondent. Naar aanleiding van dit
		onderzoek wordt een kort artikel geschreven. Indien u dit wenst te ontvangen, kunt u hieronder uw e-mailadres
		opgeven. Wij zullen dan het artikel wanneer dat klaar is naar u opsturen.
	</p>

	<?php $this->widget('common.widgets.bootstrap.TbControlGroup', array(
		'model' => $model,
		'items' => array(
			'emailAdress' => array(
				'type' => TbControlGroup::TEXT_FIELD,
				'htmlOptions' => array(
					'class' => 'span8',
				)
			),
		)
	)); ?>
	<?php $this->renderPartial('wizardControls',array('nextHeader' => 'afronden &raquo;')) ?>
	<?php $this->endWidget(); ?>


</div>

