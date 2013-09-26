<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="nl"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang="nl"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang="nl"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="nl"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width">
    <base href="<?php echo Yii::app()->request->getBaseUrl(true); ?>/"/>
    <title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>
<?php $this->beginWidget("application.widgets.uniframe.CaveFrame",
    Yii::app()->params['configurations']['uniframe']['options']); ?>


<section class="container" style="width: 250px;">
            <?php echo $content; ?>
</section>

<?php $this->endWidget(); ?>


</body>
</html>




