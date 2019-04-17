
<dl>
	<dt><h3>文章排行</h3></dt>
	<?php
			if ($cat != -45)
			{
				popular_posts_new($cat, 1, 8, 7);
			}
			else
			{
				popular_posts_new(0, 1, 8, 7);
			}
	?>
	
</dl>

<?php include_once('glbRightPhotos_new.php'); ?>

