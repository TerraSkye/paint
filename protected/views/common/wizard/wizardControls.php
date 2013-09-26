<?php
/**
 * @var $action IWizardAction
 * @var $canSkip
 * @var $nextText
 * @var $prevText
 */

$prevText = isset($prevText) ? $prevText : Yii::t('text', '&laquo; Vorige');
$nextText = isset($nextText) ? $nextText : Yii::t('text', 'Verder &raquo;');
?>
<div class="section-divider"></div>
<?php if (($action = $action->getPreviousAction($this->actions())) !== null): ?>
	<?php echo CHtml::link($prevText, $this->createUrl($action,array('filters' => true)), array('class' => 'btn', 'encode' => false)); ?>
<?php endif; ?>
<?php echo CHtml::submitButton($nextText, array('class' => 'btn btn-submit', 'encode' => false)); ?>
<div class="clearfix"></div>
