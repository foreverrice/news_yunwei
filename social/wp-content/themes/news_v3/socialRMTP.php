<?php
	$photosData = unserialize(file_get_contents(dirname(__FILE__).'/socialRMTPData.cache'));
?>          
<div class="related-box">
	<h2>热门图片推荐</h2>
	<ul class="hot-img clearfix">
		<?php for ($i = 0; $i < 4; $i++) { ?>
		<li>
			<div>
				<a href="<?=$photosData['links'][$i]?>" title="<?=$photosData['titles'][$i]?>" target="_blank">
					<img src="<?=$photosData['imgs'][$i]?>" width="143" height="100" />
				</a>
			</div>
			<div class="title">
				<a href="<?=$photosData['links'][$i]?>" title="<?=$photosData['titles'][$i]?>" target="_blank"><?=$photosData['titles'][$i]?></a>
			</div>
		</li>
		<?php }?>
	</ul>
</div>