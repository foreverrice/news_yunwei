<?php include_once('heade_new.php'); ?>
	<div class="main clearfix">
		<div class="l">
			<div class="breadCrumbs">
				<?php if(is_category() || is_page()) : ?>
				当前位置：<a href="<?php bloginfo('url'); ?>">资讯首页 </a>
				<?php
					if (!is_page())
					{
						echo " &gt; ";

						the_category(', ');
					}
					
					if (is_page())
					{
						echo " &gt; ";
						the_title();
					}
				?>
				<?php endif; ?>

				<?php if (is_tag()) : ?>
				<?php echo "标签 : ".single_tag_title( '', false ); ?>
				<?php endif; ?>
			</div>
			<div class="postList">
				<?php if (have_posts()) : $count=1; while (have_posts()) : the_post(); ?>
				<div <?php post_class("list") ?> id="post-<?php the_ID(); ?>" <?php if(is_sticky()) :?> <?php endif; ?>>
					<div class="clearfix">
					<?php
						if ( has_post_thumbnail($post->ID)) {
					?>
						<a class="bookmark" href="<?php the_permalink();?>"><?php the_post_thumbnail(150, array('title' => get_post($post->ID)->post_title, 'alt' => get_post($post->ID)->post_title)); ?></a>
					<?php
						}
					?>
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
