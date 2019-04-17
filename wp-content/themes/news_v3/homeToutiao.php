<?php
	$sliderData = unserialize(file_get_contents(dirname(__FILE__).'/homeToutiaoData.cache'));
?>
<div class="top clearfix">
	<div class="tl">
		<a href="<?=$sliderData['links'][0]?>" title="<?=$sliderData['titles'][0]?>"><img src="<?=$sliderData['imgs'][0]?>" /></a>
		<h3><a href="<?=$sliderData['links'][0]?>" title="<?=$sliderData['titles'][0]?>"><?=$sliderData['titles'][0]?></a></h3>
		<div><?=$sliderData['texts'][0]?></div>
	</div>
	<ul class="tr">
		<li>
			<h3><a href="<?=$sliderData['toutiaoListLinks'][0]?>"><?=$sliderData['toutiaoList'][0]?></a></h3>
			<div><?=$sliderData['toutiaoListTexts'][0]?></div>
		</li>
		<li>
			<h3><a href="<?=$sliderData['toutiaoListLinks'][1]?>"><?=$sliderData['toutiaoList'][1]?></a></h3>
			<div><?=$sliderData['toutiaoListTexts'][1]?></div>
		</li>
		<li>
			<h3><a href="<?=$sliderData['toutiaoListLinks'][2]?>"><?=$sliderData['toutiaoList'][2]?></a></h3>
			<div><?=$sliderData['toutiaoListTexts'][2]?></div>
		</li>
	</ul>
</div>