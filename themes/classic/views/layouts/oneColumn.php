<?php $this->beginContent('//layouts/main'); ?>
<nav class="menu-top">
	<?php $this->renderPartial('//layouts/_menuTop'); ?>
</nav>
<section class="content-center">
	<div class="content-inner">
		<?php echo $content; ?>
	</div>
</section>
<?php $this->endContent(); ?>