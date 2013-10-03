<?php $this->beginContent('//layouts/main'); ?>
<nav class="menu-top">
	<?php $this->renderPartial('//layouts/_menuTop'); ?>
</nav>
<section class="content-center">
	<?php echo $content; ?>
</section>
<?php $this->endContent(); ?>