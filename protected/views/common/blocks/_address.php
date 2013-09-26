<?php
/**
 * @var $this->contact AddressForm
 */
?>

<?php if ($this->contact->primaryAddress !== null): ?>
	<div class="row-fluid">
		<div class="span4">
			<?php echo Yii::t('text', 'Straat & huisnummer'); ?>
		</div>
		<div class="span8">
			<?php echo CHtml::encode($this->contact->primaryAddress->street . ' ' . $this->contact->primaryAddress->housenumber); ?>
		</div>
	</div>

	<div class="row-fluid">
		<div class="span4">
			<?php echo $this->contact->primaryAddress->zipCode->getAttributeLabel('value'); ?>
		</div>
		<div class="span8">
			<?php echo CHtml::encode($this->contact->primaryAddress->zipCode); ?>
		</div>
	</div>

	<div class="row-fluid">
		<div class="span4">
			<?php echo $this->contact->getAttributeLabel('city'); ?>
		</div>
		<div class="span8">
			<?php echo CHtml::encode($this->contact->primaryAddress->city); ?>
		</div>
	</div>
<?php endif; ?>

<?php if(isset($showPhoneNumbers) && $showPhoneNumbers == true):?>
<?php if ($this->contact->primaryPhoneNumber !== null): ?>
	<div class="row-fluid">
		<div class="span4">
			<?php echo $this->contact->primaryPhoneNumber->getAttributeLabel('value'); ?>
		</div>
		<div class="span8">
			<?php echo CHtml::encode($this->contact->primaryPhoneNumber); ?>
		</div>
	</div>
<?php endif; ?>

<?php if ($this->contact->optionalPhoneNumber !== null): ?>
	<div class="row-fluid">
		<div class="span4">
			<?php echo $this->contact->optionalPhoneNumber->getAttributeLabel('value'); ?>
		</div>
		<div class="span8">
			<?php echo CHtml::encode($this->contact->optionalPhoneNumber); ?>
		</div>
	</div>
<?php endif; ?>

<?php endif;?>