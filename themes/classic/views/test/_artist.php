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
        Graag willen we ons onderzoek afsluiten door u nog een vraag te stellen die leuk is om te beantwoorden.
        Hieronder vindt u een lijst met best een groot aantal kunstenaars. Misschien kent u er een heleboel, misschien
        kent u ze lang niet allemaal. Dat is niet erg. Als u een kunstenaar niet (of niet goed genoeg) kent, dan kunt u
        dat aangeven. Wilt u voor ieder van de onderstaande kunstenaars aangeven of u hem of haar kent en (als u de
        kunstenaar kent) hoe aantrekkelijk u zijn/ haar werk vindt?
    </p>

    <div class="section-header">
        kunstenaars
    </div>
    <?php $models = Artist::model()->findAll();?>


   <?php $left =array_slice($models,0,intval(count($models)/2))?>
   <?php $right =array_slice($models,count($left),intval(count($models)/2))?>

    <div class="row-fluid">
        <div class="span6">

    <table>
        <thead>
        <th colspan="7">

        </th>
        <th>
            Het werk van deze kunstenaar ken ik niet voldoende om een mening over te hebben
        </th>

        </thead>
        <tbody>
        <?php foreach ($left as $artist): ?>
            <tr>
                <th class="span4">
                    <?php echo $artist ?>
                </th>
                <?php for ($i = 1; $i < 7; $i++): ?>
                    <td class="span1">
                        <?php echo $form->radioButton($model, "artist[$artist->primaryKey]", array('value' => $i)) ?>

                    </td>
                <?php endfor; ?>
                <td class="span2" style="text-align: center">
                    <?php echo $form->radioButton($model, "artist[$artist->primaryKey]", array('value' => -1)) ?>
                </td>
            </tr>

        <?php endforeach; ?>
        </tbody>
    </table>
 </div>
        <div class="span6">

            <table>
                <thead>
                <th colspan="7">

                </th>
                <th>
                    Het werk van deze kunstenaar ken ik niet voldoende om een mening over te hebben
                </th>

                </thead>
                <tbody>
                <?php foreach ($right as $artist): ?>
                    <tr>
                        <th class="span4">
                            <?php echo $artist ?>
                        </th>
                        <?php for ($i = 1; $i < 7; $i++): ?>
                            <td class="span1">
                                <?php echo $form->radioButton($model, "artist[$artist->primaryKey]", array('value' => $i)) ?>

                            </td>
                        <?php endfor; ?>
                        <td class="span2" style="text-align: center">
                            <?php echo $form->radioButton($model, "artist[$artist->primaryKey]", array('value' => -1)) ?>
                        </td>
                    </tr>

                <?php endforeach; ?>
                </tbody>
            </table>


        </div>
    </div>
    <?php $this->renderPartial('wizardControls') ?>
    <?php $this->endWidget(); ?>


