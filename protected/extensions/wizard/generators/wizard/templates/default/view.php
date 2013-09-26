<?php
/**
 * @var $this CController
 *
 */
?>

<?php echo '
<?php /**BEGIN WIZARD HEADER FORM**/
$this->renderPartial("common.modules.user.views.registration.wizard._header", array(
	"info" => "HEADER",
	"counter" => array(1, 1),
	"header" => "Jouw Studentenpas aanvragen",
))?>
' . "\n\n";
?>

<div class="registration-form">
	<?php echo '
	<?php $form = $this->beginWidget("wizard.widgets.WizardForm", array(
		"id" => "address-form",
		"type" => "horizontal",
		"enableAjaxValidation" => false,
		"action" => $this->createUrl($action->id),
		"model" => $model,
	));
	/**END WIZARD HEADER FORM**/
	?>
	' . "\n\n";?>


	<span class="section-header"><?php echo '<?php echo Yii::t("header", "Adresgegevens"); ?>'; ?></span>



	<?php echo '<?php $this->renderPartial("common.modules.user.views.registration.wizard._navigation"); ?>'."\n\n"; ?>

	<?php echo '<?php $this->endWidget(); ?>'."\n\n" ?>
</div>