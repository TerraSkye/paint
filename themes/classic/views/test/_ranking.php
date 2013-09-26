

<div class="container">
    <div class="registration-form">

        <?php $form = $this->beginWidget('application.widgets.bootstrap.TbActiveForm', array(
            'id' => 'credit-create-transaction-form',
            'type' => 'horizontal',
            'enableAjaxValidation' => false,
            'action' => $this->createUrl($action->id),
        )); ?>
    <div class="row-fluid">
        <div class="span1 well well-small">

            <?php echo CHtml::activeTextField($model,'test')?>
            image
        </div>
        <div class="span1 well well-small">

            image
        </div>

        <div class="span1 well well-small">

            image
        </div>

        <div class="span1 well well-small">

            image
        </div>
        <div class="span1 well well-small">

            image
        </div>
        <div class="span1 well well-small">

            image
        </div>
        <div class="span1 well well-small">

            image
        </div>
        <div class="span1 well well-small">

            image
        </div>
        <div class="span1 well well-small">

            image
        </div>
        <div class="span1 well well-small">

            image
        </div>
        <div class="span1 well well-small">

            image
        </div>
        <div class="span1 well well-small">

            image
        </div>

    </div>
    <?php $this->renderPartial('wizardControls') ?>
     <?php $this->endWidget();?>
</div>


