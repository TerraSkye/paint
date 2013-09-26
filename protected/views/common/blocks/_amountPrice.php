<?php
/**
 * @var $amount integer
 * @var $model CreditPrice
 */
?>
<?php $model = CreditPrice::model()->current()->forAmount($amount)->find(); ?>

<?php if($model !== null): ?>
<table class="table table-condensed table-bordered">
	<tr class="info"><td><?php echo Yii::t('text', 'Stukprijs (exc. BTW)'); ?></td><td>&euro; <?php echo $model->pricePerUnit(false); ?></td></tr>
	<tr class="warning"><td><?php echo Yii::t('text', 'Totaalprijs (exc. BTW)'); ?></td><td>&euro; <?php echo $model->priceTotal(false); ?></td></tr>
	<tr class="success"><td><?php echo Yii::t('text', 'Totaalprijs (inc. BTW)'); ?></td><td>&euro; <?php echo $model->priceTotal(); ?></td></tr>
</table>
<?php endif; ?>