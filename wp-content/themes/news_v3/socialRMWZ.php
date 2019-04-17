<?php
	$photosData = unserialize(file_get_contents(dirname(__FILE__).'/socialRMWZData.cache'));
?>          
<div class="renqi-img">
	<?php for ($i = 0; $i < 2; $i++) { ?>
	<div>
		<p>
			<a href="<?=$photosData['links'][$i]?>" title="<?=$photosData['titles'][$i]?>" target="_blank">
				<img src="<?=$photosData['imgs'][$i]?>" width="170" height="117" />
			</a>
		</p>
		<p class="title">
			<a href="<?=$photosData['links'][$i]?>" title="<?=$photosData['titles'][$i]?>" target="_blank"><?=$photosData['titles'][$i]?></a>
		</p>
	</div>
	<?php }?>
</div>