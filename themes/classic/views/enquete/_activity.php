<div class="registration-form">

    <?php $form = $this->beginWidget('application.widgets.bootstrap.TbActiveForm', array(
        'id' => 'credit-create-transaction-form',
        'type' => 'horizontal',
        'enableAjaxValidation' => false,
        'action' => $this->createUrl($action->id),
    )); ?>

    <div class="section-header">
        Inleiding
    </div>
    <p>
        Hieronder staat een aantal activiteiten die mensen in hun vrije tijd kunnen ondernemen.
        Kunt u aangeven hoe vaak u deze activiteiten ongeveer PER JAAR onderneemt?

    </p>

    <div class="section-header">
        Vrije tijd
    </div>


    <div class="row-fluid">
        <div class="span6">
            <?php foreach (($models = Activity::model()->findAll()) as $i => $activity): ?>

            <?php if ((((count($models) +1) / 2) - $i) == 0): ?>
        </div>
        <div class="span6">
            <?php endif; ?>
            <?php $this->widget('common.widgets.bootstrap.TbControlGroup', array(
                'model' => $model,
                'label' => $activity->value,
                'labelClass' =>'control-label span8',
                'controlCss' =>'controls controls-row span4',
                'items' => array(
                    "activity[{$activity->primaryKey}]" => array(
                        'type' => TbControlGroup::TEXT_FIELD,
                         'htmlOptions' => array(
                            'class' => 'span8',
                        )
                    ),
                )
            )); ?>
            <?php endforeach; ?>
        </div>
    </div>
    <?php $this->renderPartial('wizardControls') ?>
    <?php $this->endWidget(); ?>


