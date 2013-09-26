<?php $this->beginContent('//layouts/main'); ?>
<nav class="menu-top">
	<?php $this->renderPartial('//layouts/_menuTop'); ?>
</nav>
<?php $this->widget('application.widgets.bootstrap.TbBreadcrumbs', array(
    'links'=>$this->breadCrumbs,
)); ?>
<section class="content-span2">
	<?php echo $content; ?>
</section>
<aside class="content-right">
	<?php $this->renderPartial('//layouts/_sidebar'); ?>
</aside>
<?php $this->endContent(); ?>