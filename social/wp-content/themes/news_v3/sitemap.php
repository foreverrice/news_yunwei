<?php
/**
 * Template Name: 网站地图
 */ 
 ?>

<?php get_header(); ?>
<div id="main" >
<div id="s-page">
<?php
	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
	$args = array(
        'order' => 'DESC',
	'showposts' => '50',
	'paged' => $paged,

       );
      query_posts($args);
?>
<?php if (have_posts()) : $count=1; while (have_posts()) : the_post(); ?>
<div id="archive">
	<span id="a-title"><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></span>
	<span id="a-date"><?php the_time('Y-m-d') ?></span>
</div>
<?php endwhile; endif; ?>


</div>
	<div class="navigation">
		<div class="wp-pagenavi">
			<?php par_pagenavi(); ?>
		</div>
	</div>
</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>