<?php
/**
 * Created by JetBrains PhpStorm.
 * User: sadema
 * Date: 5-3-13
 * Time: 16:50
 * To change this template use File | Settings | File Templates.
 */

?>
<div class="menu-top-logo">
    <a href="#" class="logo" title="Studentenpas.nl">Logo</a>
</div>
<div class="menu-top-container">
    <?php


    $menuItems = array(
        array('label' => 'Home', 'url' => Yii::app()->request->getBaseUrl(true), 'active' => Yii::app()->controller->route == 'site/index'),
        array(
            'label' => 'Clienten',
            'url' => array('/user/client/index'),
            'active' => Yii::app()->controller->id == 'client',
            'visible'=> Yii::app()->user->checkAccess('viewClient'),
        ),
        array('label' => 'Login', 'url' => array('/contact/login'), 'visible' => Yii::app()->user->isGuest),
        array('label' => 'logout (' . Yii::app()->user->name . ')',
            'url' => array('/contact/logout'), 'visible' => !Yii::app()->user->isGuest),

    );
    if (!Yii::app()->user->isGuest)
        $this->widget('zii.widgets.CMenu', array(
            'items' => $menuItems,
            'activeCssClass' => 'active',
            'activateItems' => true,
        ));
    ?>
</div>
<div class="menu-top-request">
    <div class="menu-top-request">
        <?php
        if (!Yii::app()->user->isGuest && Yii::app()->user->checkAccess('createClient'))
            echo CHtml::link('Client Toevoegen »', Yii::app()->controller->createUrl('/user/client/create/'), array('class' => 'btn btn-primary magenta'))
        ?>
    </div>
</div>

