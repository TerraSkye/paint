<?php $this->beginContent('//layouts/main'); ?>

<nav class="menu-top">
	<?php $this->renderPartial('//layouts/_menuTop'); ?>
</nav>
<aside class="content-left">
	<?php $this->renderPartial('//layouts/_menuLeft'); ?>
</aside>
<section class="content-span1">
	<?php echo $content; ?>
</section>
<aside class="content-right">
	<?php $this->renderPartial('//layouts/_sidebar'); ?>
</aside>
<?php $this->endContent(); ?>