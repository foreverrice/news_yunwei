<?php
	$photosData = unserialize(file_get_contents(dirname(__FILE__).'/socialRSCData.cache'));
?>

<div class="hot mgt20">
	<h2>新闻热搜词</h2>
	<div class="key">
		<ul class="key1">
			<?php for ($i = 0; $i < 12; $i++) { ?>
            <li>
				<a href="<?=$photosData['links'][$i]?>" title="<?=$photosData['titles'][$i]?>" target="_blank" class="<?php echo $photosData['class'][$i] ? 'blue' : '' ;?>"><?=$photosData['titles'][$i]?></a>
			</li>
			<?php }?>
        </ul>
	</div>
</div>