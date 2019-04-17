<?php
	$post_cate = get_the_category();
?>

<?php 
  if($post->ID <= 5570)
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

<?php
// 社会新闻
if ($post_cate_id == 110) {
?>

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
							<span>发布于<a href="<?php the_permalink(); ?>"><?php the_time('Y-m-d H:i:s');?></a></span>
							<span><?php the_tags('标签：', ', ', ''); ?></span>
						</div>
						<div class="entry group">

						<?php the_content(); ?>
						
						<p>
						<?php wp_link_pages(array('before' => '<div class="Pages clearfix">', 'after' => '', 'next_or_number' => 'next', 'previouspagelink' => '<span><<上一页</span>', 'nextpagelink' => "")); ?><?php wp_link_pages(array('before' => '', 'after' => '', 'next_or_number' => 'number', 'link_before' =>'<span>', 'link_after'=>'</span>')); ?><?php wp_link_pages(array('before' => '', 'after' => '</div>', 'next_or_number' => 'next', 'previouspagelink' => '', 'nextpagelink' => "<span style='margin-left:5px;'>下一页>></span>")); ?>
						</p>
						
						<?php get_via_link($post); ?>
						</div>
					</div>
					<?php endwhile; else: ?>

					<p><?php _e('对不起，您查找的文章不存在！'); ?></p>
					
					<?php endif; ?>

					


					<div class="related-box">
						<div class="top clearfix">
							<div class="prev-next">
								<?php
                                          		      		// 上一篇 下一篇
                                                			//add_filter("the_content", "getPreviousAndNextPost", 2);
                                        				getPreviousAndNextPost();
								?>
							</div>
							<div id="social-jiathis">
								<!-- JiaThis Button BEGIN -->
								<div class="jiathis_style_32x32">
									<a class="jiathis_button_qzone"></a>
									<a class="jiathis_button_tsina"></a>
									<a class="jiathis_button_tqq"></a>
									<a class="jiathis_button_renren"></a>
									<a href="http://www.jiathis.com/share" class="jiathis jiathis_txt jtico jtico_jiathis" target="_blank"></a>
									<a class="jiathis_counter_style"></a>
								</div>
								<script type="text/javascript" src="http://v3.jiathis.com/code/jia.js?uid=1373759563362775" charset="utf-8"></script>
								<!-- JiaThis Button END -->
							</div>
						</div>
						
						<h3>更多关于本篇文章的相关阅读：</h3>
						<ul class="more fl clearfix">
						<?php
							$post_num = 5;
							$exclude_id = $post->ID;
							$posttags = get_the_tags();
							$i = 0;

							if ( $posttags )
							{
								$tags = '';
								
								foreach ( $posttags as $tag ) $tags .= $tag->term_id . ',';
								
								$args = array(
									'cat'				=> 110,
									'post_status'		=> 'publish',
									'tag__in'			=> explode(',', $tags),
									'post__not_in'		=> explode(',', $exclude_id),
									'caller_get_posts'	=> 1,
									'orderby'			=> 'comment_date',
									'posts_per_page'	=> $post_num
								);
								
								query_posts($args);

								while( have_posts() )
								{
									the_post();
						?>
									<li>
										<a rel="bookmark" title="<?php the_title(); ?>" href="<?php the_permalink(); ?>">
											<p><?php the_title(); ?></p>
										</a>
										<span class="time">(<?php the_time('Y-m-d');?>)</span>
									</li>
						<?php
									$exclude_id .= ',' . $post->ID; $i ++;
								}
								wp_reset_query();
							}
							if ( $i < $post_num )
							{
								$cats = '';
								
								foreach ( get_the_category() as $cat ) $cats .= $cat->cat_ID . ',';
								
								$args = array(
									'cat'				=> 110,
									//'category__in'		=> explode(',', $cats),
									'post__not_in'		=> explode(',', $exclude_id),
									'caller_get_posts'	=> 1,
									'orderby'			=> 'comment_date',
									'posts_per_page'	=> $post_num - $i
								);

								query_posts($args);
								
								while( have_posts() )
								{
									the_post();
						?>
									<li>
										<a rel="bookmark" title="<?php the_title(); ?>" href="<?php the_permalink(); ?>">
											<p><?php the_title(); ?></p>
										</a>
										<span class="time">(<?php the_time('Y-m-d');?>)</span>
									</li>
						<?php
									$exclude_id .= ',' . $post->ID; $i ++;
								} 
								wp_reset_query();
							}
							if ( $i < $post_num )
							{
								$args = array(
									'cat'				=> 110,
									'post__not_in'		=> explode(',', $exclude_id),
									'caller_get_posts'	=> 1,
									'orderby'			=> 'rand',
									'posts_per_page'	=> $post_num - $i
								);
								
								query_posts($args);
								
								while( have_posts() )
								{
									the_post();
						?>
									<li>
										<a rel="bookmark" title="<?php the_title(); ?>" href="<?php the_permalink(); ?>">
											<p><?php the_title(); ?></p>
										</a>
										<span class="time">(<?php the_time('Y-m-d');?>)</span>
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

					

					<!-- 热门图片推荐 -->
					<?php include_once('socialRMTP.php'); ?>

					<!-- 人气文章推荐 -->
					<?php
						$tmp = unserialize(file_get_contents(dirname(__FILE__).'/socialRMWZData.cache'));

						foreach ($tmp['links'] as $t)
						{
							preg_match("/http:\/\/news.ci123.com\/article\/(.*?).html/i", $t, $temp);
							$exclude_id .= ',' . $temp[1];
						}
					?>
					<div class="related-box">
						<h2>热门文章推荐</h2>
						<div id="social-renqi" class="clearfix">
							<ul class="renqi-title clearfix">
							<?php
								$args = array(
									'cat'				=> 110,
									'post_status'		=> 'publish',
									'post__not_in'		=> explode(',', $exclude_id),
									'caller_get_posts'	=> 1,
									'orderby'			=> 'comment_date',
									'posts_per_page'	=> 11
								);
								
								query_posts($args);

								while( have_posts() )
								{
									the_post();
							?>
									<li>
										<a rel="bookmark" title="<?php the_title(); ?>" href="<?php the_permalink(); ?>">
											<p><?php echo mb_strimwidth(strip_tags(apply_filters('the_title', $post->post_title)), 0, 44, ""); ?></p>
										</a>
										<span class="time">(<?php the_time('m-d');?>)</span>
									</li>
							<?php
									$exclude_id .= ',' . $post->ID; $i ++;
								}
								wp_reset_query();
							?>
							</ul>
							
							<?php include_once('socialRMWZ.php'); ?>

						</div>
					</div>
					

					<script type="text/javascript">
						$(function(){
							var lheight = $(".main .l").height();
							var rheight = $(".main .r").height();

							if (lheight < rheight)
							{
								$(".main .l").css({"height": rheight});
							}
						});
					</script>

				</div>
				<div class="r">
					<?php get_sidebar(); ?>
				</div>
			</div>
		<?php include_once('footer_social.php'); ?>



<?php } else { 

	
	?>



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
								<span>发布于<a href="<?php the_permalink(); ?>"><?php the_time('Y-m-d H:i:s');?></a></span>
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

						<!--div class="mgtb20">
							<script type="text/javascript">
/*育儿news内页*/
var cpro_id = "u1373266";
</script>
<script src="http://cpro.baidustatic.com/cpro/ui/c.js" type="text/javascript"></script>

						</div-->

						<div style="width:630px;margin:0px auto 20px;">
                                                        <iframe width="630" height="170" scrolling="no" name="newsad" frameborder="0" src="http://baby.ci123.com/qq/iframe/news_ad.php"></iframe>
                                                </div>

						<div id="shareBtn" class="clearfix">
							<!-- Baidu Button BEGIN -->
							<div id="bdshare" class="bdshare_t bds_tools_32 get-codes-bdshare" style="margin-top:-5px;">
							<a class="bds_qzone"></a>
							<a class="bds_tsina"></a>
							<a class="bds_tqq"></a>
							<a class="bds_renren"></a>
							<a class="bds_t163"></a>
							<span class="bds_more"></span>
							<a class="shareCount"></a>
							</div>
							<script type="text/javascript" id="bdshare_js" data="type=tools&amp;uid=0" ></script>
							<script type="text/javascript" id="bdshell_js"></script>
							<script type="text/javascript">
							document.getElementById("bdshell_js").src = "http://bdimg.share.baidu.com/static/js/shell_v2.js?cdnversion=" + Math.ceil(new Date()/3600000)
							</script>
							<!-- Baidu Button END -->
							<div class="weixin-box fr">
								<span>关注公众帐号</span>
								<div id="ci123-weixin">
									<img src="http://news.ci123.com/images/ci123_weixin_32.png" width="32" />
									<div>
										<img src="http://news.ci123.com/images/ci123_weixin.jpg" width="215" />
										育儿网<br />以心交流，用爱育儿
									</div>
								</div>
								<div id="yunqi-weixin">
									<img src="http://news.ci123.com/images/yunqi_weixin_32.png" width="32" />
									<div>
										<img src="http://news.ci123.com/images/yqtx.png" width="215" />
										孕期提醒<br />伴你孕期每一天
									</div>
								</div>
								<div id="mamagou-weitao">
									<img src="http://news.ci123.com/images/mamagou_weitao_32.png" width="32" />
									<div>
										<img src="http://news.ci123.com/images/mmg_weitao.jpg" width="215" />
										用 淘宝客户端 扫描二维码<br />关注妈妈购微淘 获取更多优惠资讯
									</div>
								</div>
							</div>
							<script type="text/javascript">
								$(function(){
									$('.weixin-box>div').hover(function(){
										$('div', this).show();
									}, function(){
										$('div', this).hide();
									});
								});
							</script>
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


<?php } ?>
