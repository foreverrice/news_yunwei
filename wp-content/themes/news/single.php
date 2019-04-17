<?php 
  if($post->ID<5800)
  {
	   get_header();
  }
  else
  {
	  include_once('heade_new.php'); 
  }

?>

	<style type="text/css">
	.post .entry p { text-indent: 2em; }
	</style>
	<div class="main clearfix">
		<div class="l">
			<div class="breadCrumbs">
				<?php if(is_single() || is_category()  || is_page()) : ?>
				当前位置：<a href="<?php bloginfo('url'); ?>">资讯首页 </a>
				<?php
					if (!is_page())
					{
						echo " &gt; ";
						the_category(', ');
					}
				?>
				<?php
					if (is_single())
					{
						echo " &gt; <a href='";
						the_permalink();
						echo "'>";
						the_title();
						echo "</a>";
					}
				?>
				<?php endif; ?>
			</div>

			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

			<div class="post" id="post">
				<h1 class="postTitle"><?php the_title();?></h1>
				<div class="postInfo">
					<span>发布于<a href="<?php the_permalink(); ?>"><?php the_time('Y-m-d H:i');?></a></span>
					<span><?php the_tags('标签：', ', ', ''); ?></span>
				</div>
				<div class="entry group">
				<?php the_content(); ?>
				<?php get_via_link($post); ?>
				</div>
			</div>
			<?php endwhile; else: ?>

			<p><?php _e('对不起，您查找的文章不存在！'); ?></p>
			
			<?php endif; ?>

			<div id="shareBtn" class="clearfix">
				<div class="fl" style="padding-top: 7px;">保存到：</div>
				<!-- JiaThis Button BEGIN -->
				<div class="jiathis_style_32x32">
				<a class="jiathis_button_qzone" title="保存到QQ空间"></a>
				<a class="jiathis_button_tsina" title="保存到新浪微博"></a>
				<a class="jiathis_button_tqq" title="保存到腾讯微博"></a>
				<a class="jiathis_button_renren" title="保存到人人网"></a>
				<a class="jiathis_button_kaixin001" title="保存到开心网"></a>
				<a class="jiathis_button_douban" title="保存到豆瓣"></a>
				<a class="jiathis_button_miliao" title="保存到米聊"></a>
				<a href="http://www.jiathis.com/share?uid=1699730" class="jiathis jiathis_txt jiathis_separator jtico jtico_jiathis" target="_blank"></a>
				<a class="jiathis_counter_style"></a>
				</div>
				<script type="text/javascript" >
				var jiathis_config={
					data_track_clickback:true,
					summary:"",
					ralateuid:{
						"tsina":"2713812851"
					},
					hideMore:false
				}
				</script>
				<script type="text/javascript" src="http://v3.jiathis.com/code/jia.js?uid=1699730" charset="utf-8"></script>
				<!-- JiaThis Button END -->
				<?php comments_popup_link('0 条评论', '1 条评论', '% 条评论', 'fr br3 totalComments', '评论已关闭'); ?>
			</div>

			<div id="relatedpost">
				<h3>您可能还喜欢：</h3>
				<ul class="clearfix">
				<?php
					$post_num = 5;
					$exclude_id = $post->ID;
					$posttags = get_the_tags();
					$i = 0;
					if ( $posttags ) {
						$tags = ''; foreach ( $posttags as $tag ) $tags .= $tag->term_id . ',';
						$args = array(
							'post_status' => 'publish',
							'tag__in' => explode(',', $tags),
							'post__not_in' => explode(',', $exclude_id),
							'caller_get_posts' => 1,
							'orderby' => 'comment_date',
							'posts_per_page' => $post_num
						);
						query_posts($args);
						while( have_posts() ) {
							the_post();
				?>
							<li>
								<a rel="bookmark" title="<?php the_title(); ?>" href="<?php the_permalink(); ?>">
									<?php echo getFirstImage($post->ID, 96, 96);?>
									<p><?php the_title(); ?></p>
								</a>
							</li>
				<?php
							$exclude_id .= ',' . $post->ID; $i ++;
						}
						wp_reset_query();
					}
					if ( $i < $post_num ) {
						$cats = ''; foreach ( get_the_category() as $cat ) $cats .= $cat->cat_ID . ',';
						$args = array(
							'category__in' => explode(',', $cats),
							'post__not_in' => explode(',', $exclude_id),
							'caller_get_posts' => 1,
							'orderby' => 'comment_date',
							'posts_per_page' => $post_num - $i
						);
						query_posts($args);
						while( have_posts() ) {
							the_post();
				?>
							<li>
								<a rel="bookmark" title="<?php the_title(); ?>" href="<?php the_permalink(); ?>">
									<?php echo getFirstImage($post->ID, 96, 96);?>
									<p><?php the_title(); ?></p>
								</a>
							</li>
				<?php
							$exclude_id .= ',' . $post->ID; $i ++;
						} 
						wp_reset_query();
					}
					if ( $i < $post_num ) {
						$args = array(
							'post__not_in' => explode(',', $exclude_id),
							'caller_get_posts' => 1,
							'orderby' => 'rand',
							'posts_per_page' => $post_num - $i
						);
						query_posts($args);
						while( have_posts() ) {
							the_post();
				?>
							<li>
								<a rel="bookmark" title="<?php the_title(); ?>" href="<?php the_permalink(); ?>">
									<?php echo getFirstImage($post->ID, 96, 96);?>
									<p><?php the_title(); ?></p>
								</a>
							</li>
				<?php
							$exclude_id .= ',' . $post->ID; $i ++;
						}
						wp_reset_query();
					}
					if ( $i  == 0 )  echo '<li>没有相关文章</li>';
				?>
				</ul>
			</div>
			<div id="duoshuoDisplayDiv">
				<?php comments_template(); ?>
			 </div>
		</div>
		<div class="r">
			<?php get_sidebar(); ?>
		</div>
	</div>
<?php get_footer(); ?>
