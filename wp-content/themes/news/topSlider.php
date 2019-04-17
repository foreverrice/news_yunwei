<?php
	$topSliderDate = unserialize(file_get_contents(dirname(__FILE__).'/topSliderData.cache'));
?>
<script type="text/javascript" src="<?=bloginfo('url')?>/js/slider.js"></script>
<link href="<?=bloginfo('url')?>/styles/slider.min.css" rel="stylesheet" type="text/css" />
<div class="topSlider clearfix">
	<div id="cslider0"></div>
	<div id="cslider1"></div>
	<div id="cslider2"></div>
	<div id="cslider3"></div>
	<script type="text/javascript">
	$(function(){
		var transition=SliderTransitionFunctions['horizontalSunblind'];

		var slider0=window.slider0=new Slider(jQuery('#cslider0'));
		slider0.setPhotos(<?php echo json_encode($topSliderDate['slider0']);?>).setSize(225, 135).setTheme('no-control').setDuration(8000).setTransitionDuration(1500);
		if(transition) slider0.setTransitionFunction(transition); else slider0.setTransition('circles');

		var slider1 = window.slider1 = new Slider(jQuery('#cslider1'));
		slider1.setPhotos(<?php echo json_encode($topSliderDate['slider1']);?>).setSize(225, 135).setTheme('no-control').setDuration(8000).setTransitionDuration(1500);
		if(transition) slider1.setTransitionFunction(transition); else slider1.setTransition('circles');

		var slider2=window.slider2=new Slider(jQuery('#cslider2'));
		slider2.setPhotos(<?php echo json_encode($topSliderDate['slider2']);?>).setSize(225, 135).setTheme('no-control').setDuration(8000).setTransitionDuration(1500);
		if(transition) slider2.setTransitionFunction(transition); else slider2.setTransition('circles');

		var slider3=window.slider3=new Slider(jQuery('#cslider3'));
		slider3.setPhotos(<?php echo json_encode($topSliderDate['slider3']);?>).setSize(225, 135).setTheme('no-control').setDuration(8000).setTransitionDuration(1500);
		if(transition) slider3.setTransitionFunction(transition); else slider3.setTransition('circles');
	});
	</script>
</div>