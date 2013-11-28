<div class="registration-form">

    <?php
    /* @var $form TbActiveForm */
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
        Hieronder vindt u een lijst met best een groot aantal kunstenaars. Misschien kent u er een heleboel, misschien
        kent u ze lang niet allemaal. Dat is niet erg. Als u een kunstenaar niet (of niet goed genoeg) kent, dan kunt u
        dat aangeven door het meest rechtse bolletje te selecteren. Wilt u voor ieder van de onderstaande kunstenaars
        aangeven of u hem of haar kent en (als u de kunstenaar kent) hoe aantrekkelijk u zijn of haar werk vindt?
    </p>

    <div class="section-header">
        kunstenaars
    </div>
    <?php $models = Artist::model()->findAll(); ?>


    <?php $left = array_slice($models, 0, intval(count($models) / 2)) ?>
    <?php $right = array_slice($models, count($left), intval(count($models) / 2)) ?>

    <div class="row-fluid">
        <div class="span6">

            <table>
                <thead>
                <th class="1"></th>
                <th colspan="2" align="center" style="font-size: 40px;padding-right: 18px;">&#9785;</th>
                <th colspan="2"></th>
                <th colspan="2" align="center" style="font-size: 40px;padding-right: 18px;">&#9786;</th>

                <th>
                    onvoldoende bekend
                </th>

                </thead>
                <tbody>
                <?php foreach ($left as $Idx => $artist): ?>
                    <tr style="<?php echo  (($Idx %2) == 0) ? "background: #eeeeee" : ''?>">
                        <th class="span4">
                            <?php echo $artist ?>
                        </th>
                        <?php for ($i = 1; $i < 7; $i++): ?>
                            <td class="span1">
                                <?php //XHtml::d($i,$model->artist[$artist->PrimaryKey])?>
                                <?php echo $form->radioButton($model, "artist[$artist->primaryKey]", array('value' => "$i" , 'uncheckValue' => null)) ?>

                            </td>
                        <?php endfor; ?>
                        <td class="span2" style="text-align: center">
                            <?php echo $form->radioButton($model, "artist[$artist->primaryKey]", array('value' => -1,'uncheckValue' => null)) ?>
                        </td>
                    </tr>

                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="span6">

            <table>
                <thead>
                <th class="1"></th>
                <th colspan="2" align="center" style="font-size: 40px;padding-right: 18px;">&#9785;</th>
                <th colspan="2"></th>
                <th colspan="2" align="center" style="font-size: 40px;padding-right: 18px;">&#9786;</th>

                <th>
                    onvoldoende bekend
                </th>

                </thead>
                <tbody>
                <?php foreach ($right as $Idx =>$artist): ?>
                    <tr style="<?php echo  (($Idx %2) == 0) ? "background: #eeeeee" : ''?>">
                        <th class="span4">
                            <?php echo $artist ?>
                        </th>
                        <?php for ($i = 1; $i < 7; $i++): ?>
                            <td class="span1">
                                <?php echo $form->radioButton($model, "artist[$artist->primaryKey]", array('value' => $i,'uncheckValue' => null)) ?>

                            </td>
                        <?php endfor; ?>
                        <td class="span2" style="text-align: center">
                            <?php echo $form->radioButton($model, "artist[$artist->primaryKey]", array('value' => -1,'uncheckValue' => null)) ?>
                        </td>
                    </tr>

                <?php endforeach; ?>
                </tbody>
            </table>


        </div>
    </div>
    <?php $this->renderPartial('wizardControls') ?>
    <?php $this->endWidget(); ?>


