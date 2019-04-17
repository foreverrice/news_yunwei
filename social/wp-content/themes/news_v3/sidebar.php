<?php
$post_cate = get_the_category();
$post_cate_id = $post_cate[0]->cat_ID;

// 社会新闻
if (($post_cate_id == 110) || ($cat == 110)) {
?>

<!-- 轮播 -->
<div class="hot">
<?php include_once('socialSlider.php'); ?>
</div>

<!-- 频道推荐 -->
<div class="hot mgt20">
	<h2>频道推荐</h2>
	<ul class="hotList">
		<?php
			popular_posts(110, 1, 10, 7);
		?>
	</ul>
</div>

<!-- 新闻热搜词 -->
<?php include_once('socialRSC.php'); ?>

<!-- 百度联盟 -->

<!-- 新闻图片 -->
<?php include_once('socialRightPhotos1.php'); ?>

<!-- 百度联盟 -->


<!-- 特别推荐 -->
<?php include_once('socialRightPhotos2.php'); ?>

<?php } else { ?>
	<div class="hot">
		<?php include_once('glbRightPhotos.php'); ?>
	</div>

	<div class="hot mgt10">
		<h2>热门文章</h2>
		<ul class="hotList">
			<?php
				if ($cat)
				{
					if ($cat != -45)
					{
						popular_posts($cat, 1, 10, 7);
					}
					else
					{
						popular_posts(0, 1, 10, 7);
					}
				}
				else
				{
					if ($post_cate_id != -45)
					{
						popular_posts($post_cate_id, 1, 10, 7);
					}
					else
					{
						popular_posts(0, 1, 10, 7);
					}
				}
			?>
		</ul>
	</div>
<?php } ?>
