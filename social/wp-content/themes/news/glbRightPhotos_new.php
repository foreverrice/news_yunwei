<?php
	$photosData = unserialize(file_get_contents(dirname(__FILE__).'/glbRightPhotosDatanew.cache'));
?>          
<div class="picnews">
	<h3>图片新闻</h3>
	<?php for ($i = 0; $i < 4; $i++) { ?>
	<div class="news">
		<div class="l"><a href="<?=$photosData['links'][$i]?>" title="<?=$photosData['titles'][$i]?>"><img src="<?=$photosData['imgs'][$i]?>" width="80" height="80" /></a></div>
		<div class="r">
			<h5><a href="<?=$photosData['links'][$i]?>"><?=$photosData['titles'][$i]?></a></h5>
			<p><?=$photosData['texts'][$i]?></p>
		</div>
	</div><!--/news-->
	<?php } ?>
</div>
<div class="weixin"><div><img src="<?=bloginfo('url')?>/images/weixin.jpg" width="193" height="193" /></div>扫二维码关注我们的官方微信号</div>