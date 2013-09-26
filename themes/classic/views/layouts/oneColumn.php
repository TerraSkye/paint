<?php $this->beginContent('//layouts/main'); ?>
<nav class="menu-top">
	<?php $this->renderPartial('//layouts/_menuTop'); ?>
</nav>
<?php $this->widget('application.widgets.bootstrap.TbBreadcrumbs', array(
    'links'=>$this->breadCrumbs,
)); ?>

<section class="content-center">
	<?php echo $content; ?>
</section>
<?php $this->endContent(); ?>

