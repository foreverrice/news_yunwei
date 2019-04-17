<?php
	$photosData = unserialize(file_get_contents(dirname(__FILE__).'/socialRightSliderData.cache'));
?>
<script src="http://news.ci123.com/js/jquery.slideBox.min.js"></script>
<script type="text/javascript">
jQuery(function($){
	$('#slider-box').slideBox({
		duration : 0.3,
		easing : 'linear',
		delay : <?=$photosData['time']?>,
		hideClickBar : false,
		clickBarRadius : 14
	});
});
</script>
<div id="slider-box" class="slider-box">
	<ul class="items">
		<?php for ($i = 0; $i < $photosData['num']; $i++) { ?>
		<li>
			<a href="<?=$photosData['links'][$i]?>" title="<?=$photosData['texts'][$i]?>" target="_blank">
				<img src="<?=$photosData['imgs'][$i]?>" width="245" height="290" />
			</a>
		</li>
		<?php }?>
	</ul>
	<div class="tipsbg"></div>
</div>