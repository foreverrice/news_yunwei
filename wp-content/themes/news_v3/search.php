<?php include_once('heade_new.php'); ?>
	<div class="main clearfix">
		<div class="l">
			<div class="breadCrumbs">搜索 : "<?php the_search_query(); ?>"的搜索结果</div>
			<div class="postList">
				<?php  
					$page = (get_query_var('paged')) ? get_query_var('paged') : 1;  
					$s = get_query_var('s');  
					query_posts("s=$s&paged=$page");  
				?>
				<?php if (have_posts()) : $count=1; while (have_posts()) : the_post(); ?>
				<div <?php post_class("list") ?> id="post-<?php the_ID(); ?>" <?php if(is_sticky()) :?> <?php endif; ?>>
					<div class="clearfix">
						<?php 
							$imgurl = catch_that_image();
							if (!empty($imgurl)):
						?>
						<a class="bookmark" href="<?php the_permalink();?>"><img src="<?php echo $imgurl; ?>" title="<?php the_title(); ?>" /></a>
						<?php endif; ?>
						<div class="c">
							<h2 class="title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
							<div class="entry">
								<?php the_excerpt(); ?>
							</div>
						</div>
					</div>
					<div class="clearfix">
						<div class="info">
							<span>发表于 <a href="<?php the_permalink(); ?>"><?php the_time('Y-m-d H:i');?></a></span>
							<span>分类：<?php the_category(', '); ?></span>
							<span><?php the_tags('标签：', ', ', ''); ?></span>
						</div>
						<a class="readMore br3" href="<?php the_permalink(); ?>">阅读全文 &gt;&gt;</a>
					</div>
				</div>
				<?php endwhile; else: ?>

				<?php endif; ?>
			</div>
			<?php wp_pagenavi(); ?>
		</div>
		<div class="r">
			<?php get_sidebar(); ?>
		</div>
	</div>
<?php get_footer(); ?>
