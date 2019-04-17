<?php
/*
Template Name: Tags
*/
?>
<?php get_header(); ?>
<div id="main">
	<div id="s-page" style="float: left;">
		<div class="tag-list"><?php wp_tag_cloud('unit=px&smallest=14&largest=14&number=0&format=list&orderby=count&order=DESC'); ?></div>
	</div>	
</div>
<?php get_sidebar('right'); ?>
<?php get_footer(); ?>