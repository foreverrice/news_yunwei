<?php
	$sliderData = unserialize(file_get_contents(dirname(__FILE__).'/glbRightPhotosData.cache'));
?>
<link rel="stylesheet" href="<?=bloginfo('url')?>/styles/aw-showcase.css" />
<script type="text/javascript" src="<?=bloginfo('url')?>/js/jquery.aw-showcase.js"></script>
<script type="text/javascript">

$(document).ready(function()
{
	$("#showcase").awShowcase(
	{
		content_width:			690,
		content_height:			460,
		fit_to_parent:			false,
		auto:					false,
		interval:				3000,
		continuous:				false,
		loading:				true,
		tooltip_width:			200,
		tooltip_icon_width:		32,
		tooltip_icon_height:	32,
		tooltip_offsetx:		18,
		tooltip_offsety:		0,
		arrows:					true,
		buttons:				true,
		btn_numbers:			false,
		keybord_keys:			true,
		mousetrace:				false, 
		pauseonover:			true,
		stoponclick:			true,
		transition:				'hslide', 
		transition_delay:		300,
		transition_speed:		500,
		show_caption:			'show', 
		thumbnails:				true,
		thumbnails_position:	'outside-last', 
		thumbnails_direction:	'horizontal', 
		thumbnails_slidex:		0, 
		dynamic_height:			false, 
		speed_change:			false, 
		viewline:				false
	});
});

</script>
<div id="showcase" class="showcase">
<?php for ($i = 0; $i < $sliderData['num']; $i++) { ?>
	<div class="showcase-slide">
		<div class="showcase-content">
			<a href="<?=$sliderData['links'][$i]?>"><img src="<?=$sliderData['imgs'][$i]?>" alt="<?=$sliderData['texts'][$i]?>" /></a>
		</div>
		<div class="showcase-thumbnail">
			<img src="<?=$sliderData['imgs'][$i]?>" alt="<?=$sliderData['texts'][$i]?>" width="140px" />
			<div class="showcase-thumbnail-caption white"></div>
			<div class="showcase-thumbnail-cover"></div>
		</div>
		<div class="showcase-caption">
			<h2 class="white"><a href="<?=$sliderData['links'][$i]?>"><?=$sliderData['texts'][$i]?></a></h2>
		</div>
	</div>
<?php } ?>
</div>