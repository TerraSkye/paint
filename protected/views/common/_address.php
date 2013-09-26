<?php
/**
 * @var $form TbActiveForm
 * @var $model AddressForm
 * @var $header string
 */
?>

<?php if (isset($header)): ?>
	<?php if (!empty($header)): ?>
		<div class="section-header"><?php echo Yii::t('header', $header); ?></div>
	<?php endif; ?>
<?php else: ?>
	<div class="section-header"><?php echo Yii::t('header', 'Adresgegevens'); ?></div>
<?php endif; ?>

<?php $this->widget('common.widgets.bootstrap.TbControlGroup', array(
	'model' => $model,
	'label' => Yii::t('text', 'Straat & huisnummer'),
	'items' => array(
		'street' => array(
			'type' => TbControlGroup::TEXT_FIELD,
			'htmlOptions' => array(
				'class' => 'span6',
			)
		),
		'housenumber' => array(
			'type' => 'textField',
			'htmlOptions' => array(
				'class' => 'span2',
			)
		)
	)
)); ?>

<?php $this->widget('common.widgets.bootstrap.TbControlGroup', array(
	'model' => $model,
	'items' => array(
		'zip_code' => array(
			'type' => TbControlGroup::TEXT_FIELD,
			'htmlOptions' => array(
				'class' => 'span4',
			)
		),
	)
)); ?>

<?php $this->widget('common.widgets.bootstrap.TbControlGroup', array(
	'model' => $model,
	'items' => array(
		'city' => array(
			'type' => TbControlGroup::TEXT_FIELD,
			'htmlOptions' => array(
				'class' => 'span4',
			)
		),
	)
)); ?>

<?php if ($model->scenario == AddressForm::SCENARIO_PHONE_NUMBER): ?>
	<?php $this->widget('common.widgets.bootstrap.TbControlGroup', array(
		'model' => $model,
		'items' => array(
			'phone_number' => array(
				'type' => TbControlGroup::TEXT_FIELD,
				'htmlOptions' => array(
					'class' => 'span4',
				)
			),
		)
	)); ?>

	<?php $this->widget('common.widgets.bootstrap.TbControlGroup', array(
		'model' => $model,

		'items' => array(
			'optional_phone_number' => array(
				'type' => TbControlGroup::TEXT_FIELD,
				'htmlOptions' => array(
					'class' => 'span4',
				)
			),

		)
	)); ?>
<?php endif; ?>
