<div class="registration-form">


	<div class="section-header">
		Inleiding
	</div>
	<p>
		Hieronder ziet u vijftien schilderijen van Vincent van Gogh. Bekijkt u ze maar eens rustig; als u op één van de
		schilderijen klikt, dan wordt deze groter, zodat u de afbeelding beter kunt zien. Als u klaar bent met kijken,
		dan willen we u vragen of u vijf afbeeldingen wilt selecteren die u het mooist vindt. Deze vijf kunt u met uw
		muis in de balk onderaan het scherm slepen. Helemaal links plaatst u het schilderij dat u het minst
		aantrekkelijk vindt, helemaal rechts plaatst u het schilderij dat u het mooist vindt. De rest van de
		geselecteerde schilderijen plaats u daar tussenin in volgorde van hoe mooi u ze vindt. De overgebleven tien
		schilderijen kunt u laten staan.
	</p>

	<div class="section-header">
		Basis vragen
	</div>

	<?php echo CHtml::errorSummary($model) ?>
	<div class="wrapper">
		<div class="row-fluid">
			<div class="span10">
				<div class="section-header">
                    Overzicht schilderijen
				</div>

				<div class="drag-container ui-corner-all">
					<?php foreach (Painting::model()->findAll() as $painting): ?>
						<div class="item-wrapper ui-draggable" style="display: block;">
							<div class="item-container" style="display: block">
                                <?php echo CHtml::link(CHtml::image($painting->file_path,$painting,array('style' => 'width: 100px;height: 100px')), $painting->file_path, array(
                                    'rel' => "gallery[project]",

                                    'class' => 'thumbnail',
                                )) ?>

							</div>
							<?php echo CHtml::activeHiddenField($model, "ranking[$painting->PrimaryKey]") ?>
						</div>
					<?php endforeach; ?>
					<div class="clearfix"></div>
				</div>
				<div class="clearfix"></div>
			</div>
			<div class="span2">
				<?php
				Yii::app()->clientScript->registerCoreScript('jquery.ui');
				/* @var $form TbActiveForm */
				$form = $this->beginWidget('application.widgets.bootstrap.TbActiveForm', array(
					'id' => 'credit-create-transaction-form',
					'type' => 'horizontal',
					'enableAjaxValidation' => false,
					'action' => $this->createUrl($action->id),
				)); ?>

				<h5>Top 5</h5>

				<div class="sort-container ui-corner-all ui-sortable" style="min-height:600px;background: #cccccc;">
                    <?php foreach($model->ranking as $paint => $o):?>
                        <div class="item-wrapper ui-draggable" style="display: block;">
                            <div class="drag-handle"></div><div class="item-container" style="display: block">
                                <?php echo CHtml::link(CHtml::image(Painting::model()->findByPk($paint)->file_path,Painting::model()->findByPk($paint)->value,array('style' => 'width: 100px;height: 100px')), Painting::model()->findByPk($paint)->file_path, array(
                                    'rel' => "gallery[project]",

                                    'class' => 'thumbnail',
                                )) ?>

                            </div>
                            <?php echo CHtml::activeHiddenField($model, "ranking[$painting->PrimaryKey]") ?>
                        </div>
                    <?php endforeach?>
				</div>
			</div>
		</div>
		<?php $this->renderPartial('wizardControls') ?>
		<?php $this->endWidget(); ?>



	</div>
    <script type="text/javascript" charset="utf-8">
        $(document).ready(function () {
            $(".item-container a[rel^='gallery']").prettyPhoto();
        });
    </script>
</div>

