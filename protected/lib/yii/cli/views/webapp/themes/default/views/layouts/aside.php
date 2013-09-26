<aside>
	<div class="social">
<?php /*
		<a onmouseover="$(this).animate({top: '-5'}, 100);" onmouseout="$(this).animate({top: '0'}, 100);" href="#">&nbsp;</a>

		<a onmouseover="$(this).animate({top: '-5'}, 100);" onmouseout="$(this).animate({top: '0'}, 100);" href="#" class="twitter">&nbsp;</a>
		<a onmouseover="$(this).animate({top: '-5'}, 100);" onmouseout="$(this).animate({top: '0'}, 100);" href="#" class="hyves">&nbsp;</a>
		<a onmouseover="$(this).animate({top: '-5'}, 100);" onmouseout="$(this).animate({top: '0'}, 100);" href="#" class="youtube">&nbsp;</a>
		<a onmouseover="$(this).animate({top: '-5'}, 100);" onmouseout="$(this).animate({top: '0'}, 100);" href="#" class="myspace">&nbsp;</a>
*/ ?>
	</div>
	<?php
		$this->widget('common.widgets.slideshow.SlideShow',array('id' => 'slideshow','data' => array(
							array('path' => 'images/slideshow_pic_1.png' , 'description' => 'Winnaars Student Of The Year'),
							array('path' => 'images/slideshow_pic_2.png' , 'description' => 'Winnaars Student Of The Year'),
											))
							);
	?>
	
	
</aside>
