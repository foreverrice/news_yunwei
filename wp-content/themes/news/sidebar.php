<div class="hot">
	<?php include_once('glbRightPhotos.php'); ?>
</div>

<div class="hot mgt10">
	<h2>热门文章</h2>
	<ul class="hotList">
		<?php
			if ($cat != -45)
			{
				popular_posts($cat, 1, 10, 7);
			}
			else
			{
				popular_posts(0, 1, 10, 7);
			}
		?>
	</ul>
</div>