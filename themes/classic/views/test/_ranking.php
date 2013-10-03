
<div class="registration-form">




    <?php
    /* @var $form TbActiveForm*/
    $form = $this->beginWidget('application.widgets.bootstrap.TbActiveForm', array(
        'id' => 'credit-create-transaction-form',
        'type' => 'horizontal',
        'enableAjaxValidation' => false,
        'action' => $this->createUrl($action->id),
    )); ?>

    <div class="section-header">
        Inleiding
    </div>
    <p>
        Selecteer 5 schilderijen
    </p>
    <div class="section-header">
        Basis vragen
    </div>

    <?php echo $form->errorSummary($model)?>

    <?php echo  $form->hiddenField($model,'ranking',array('value' => "dennis is gay")) ; ?>

    <style>
        li.pull-left.well.well-small{
            list-style: none;
            width: 20%;
            border: none;
            padding:0;
            height:100px;
        }

        li img{
           height: 100px;
            width: 100px;
        }

        ul li:first-child{
            margin-left: -20px;
        }

    </style>

<ul>
    <li class="pull-left well well-small">
        <label for="ahha">
        <img src="http://static.freepik.com/vrije-photo/trollface_17-403125921.jpg"/>
        <input type="checkbox" name="ahha">
        </label>
       </li>

</ul>
    <ul>
        <li class="pull-left well well-small">
            <img src="http://static.freepik.com/vrije-photo/trollface_17-403125921.jpg"/>
        </li>
        <li class="pull-left well well-small">
            <img src="http://static.freepik.com/vrije-photo/trollface_17-403125921.jpg"/>
        </li>    <li class="pull-left well well-small">
            <img src="http://static.freepik.com/vrije-photo/trollface_17-403125921.jpg"/>
        </li>    <li class="pull-left well well-small">
            <img src="http://static.freepik.com/vrije-photo/trollface_17-403125921.jpg"/>
        </li>    <li class="pull-left well well-small">
            <img src="http://static.freepik.com/vrije-photo/trollface_17-403125921.jpg"/>
        </li>
    </ul><ul>
        <li class="pull-left well well-small">
            <img src="http://static.freepik.com/vrije-photo/trollface_17-403125921.jpg"/>
        </li>
        <li class="pull-left well well-small">
            <img src="http://static.freepik.com/vrije-photo/trollface_17-403125921.jpg"/>
        </li>    <li class="pull-left well well-small">
            <img src="http://static.freepik.com/vrije-photo/trollface_17-403125921.jpg"/>
        </li>    <li class="pull-left well well-small">
            <img src="http://static.freepik.com/vrije-photo/trollface_17-403125921.jpg"/>
        </li>    <li class="pull-left well well-small">
            <img src="http://static.freepik.com/vrije-photo/trollface_17-403125921.jpg"/>
        </li>
    </ul>

    <div class="row-fluid">
    <div class="span12 well well-small">

    </div>
    </div>

    <?php $this->renderPartial('wizardControls') ?>
    <?php $this->endWidget();?>

    </div>

