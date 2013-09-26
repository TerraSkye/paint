<?php echo "<?php /* @var \$item CFormModel**/?>]\n"?>

<span class="section-header"><?php echo $action ?></span>
<div class="well well-small">
<?php foreach ($fields as $attribute): ?>
	<div class="row-fluid">
		<div class="span4">
			<?php echo '<?php echo $item->getAttributeLabel(' . $attribute . '); ?>' . "\n" ?>
		</div>
		<div class="span8">
			<?php echo '<?php echo CHtml::encode($item->' . $attribute . ');  ?>' . "\n" ?>
		</div>
	</div>
<?php endforeach; ?>
</div>