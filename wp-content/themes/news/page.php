<?php get_header();?>
<div id="main">
	<div id="s-page">
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<div <?php post_class() ?> id="post-<?php the_ID(); ?>">
				<?php the_content(); ?>
		</div>
		<?php endwhile; else: ?>
		<div class="post">哦！您要找的日志可能已经更换地址，重新搜索一下吧，或者点击<a title="Home" class="active" href="<?php echo get_option('home'); ?>/">这里</a>回首页看看吧</div>
	<?php endif; ?>
	</div>
</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>