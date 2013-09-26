<?php
/**
 * @var $this->contact AddressForm
 */
?>

	<div class="row-fluid">
		<div class="span4">
			<?php echo Yii::t('text', 'Product'); ?>
		</div>
		<div class="span8">
			<?php echo Yii::t('text', 'CREDIT_NAME_PLACEHOLDER'); ?>
		</div>
	</div>

	<div class="row-fluid">
		<div class="span4">
			<?php echo Yii::t('text', 'Aantal'); ?>
		</div>
		<div class="span8">
			<?php echo $model->amount; ?>
		</div>
	</div>

<?php if($model->transactionMethod === 'money'): ?>
	<?php $creditPrice = CreditPrice::model()->current()->forAmount($model->amount)->find(); ?>

	<div class="row-fluid">
		<div class="span4">
			<?php echo Yii::t('text', 'Prijs (exc. BTW)'); ?>
		</div>
		<div class="span8">
			&euro; <?php echo $creditPrice->priceTotal(false); ?>
		</div>
	</div>

	<div class="row-fluid">
		<div class="span4">
			<?php echo Yii::t('text', 'Prijs (inc. BTW)'); ?>
		</div>
		<div class="span8">
			&euro; <?php echo $creditPrice->priceTotal(); ?>
		</div>
	</div>

<?php elseif($model->transactionMethod === 'coupon'): ?>

<div class="row-fluid">
	<div class="span4">
		<?php echo Yii::t('text', 'Betaalwijze'); ?>
	</div>
	<div class="span8">
		<?php echo Yii::t('text', 'Coupon'); ?>
	</div>
</div>

<?php endif; ?>
