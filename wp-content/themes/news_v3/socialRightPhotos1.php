<?php
	$photosData = unserialize(file_get_contents(dirname(__FILE__).'/socialRightPhotos1Data.cache'));
?>          
<div class="hot mgt20">
	<h2>新闻图片</h2>
	<ul class="picnews clearfix">
		<?php for ($i = 0; $i < 6; $i++) { ?>
		<li>
			<a href="<?=$photosData['links'][$i]?>" title="<?=$photosData['titles'][$i]?>" target="_blank">
				<img src="<?=$photosData['imgs'][$i]?>" width="111" height="86" />
			</a>
			<p><a href="<?=$photosData['links'][$i]?>" title="<?=$photosData['titles'][$i]?>" target="_blank"><?=$photosData['titles'][$i]?></a></p>
		</li>
		<?php } ?>
	</ul>
</div>