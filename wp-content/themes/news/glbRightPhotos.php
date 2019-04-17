<?php
	$photosData = unserialize(file_get_contents(dirname(__FILE__).'/glbRightPhotosData.cache'));
?>
	<h2>图说</h2>
	<ul class="tushuo">
		<?php for ($i = 0; $i < 4; $i++) { ?>
			<li>
				<div class="clearfix">
					<a href="<?=$photosData['links'][$i]?>" title="<?=$photosData['titles'][$i]?>"><img class="img" src="<?=$photosData['imgs'][$i]?>" /></a>
					<div class="info">
						<h3><a href="<?=$photosData['links'][$i]?>" title="<?=$photosData['titles'][$i]?>"><?=$photosData['titles'][$i]?></a></h3>
						<div><?=$photosData['texts'][$i]?></div>
					</div>
				</div>
			</li>
		<?php } ?>
	</ul>
