<?php
include_once("cron/inc/config.php");
//include_once(ABSPATH."wp-content/themes/news_v3/functions.php");
$bbsdata = json_decode(file_get_contents("/opt/ci123/www/html/news/wp-content/themes/news_v3/bbsRpc.cache"));
$baikedata = json_decode(file_get_contents("/opt/ci123/www/html/news/wp-content/themes/news_v3/keywords.cache"));
$con = mysql_connect(DB_HOST,DB_USERNAME,DB_PASSWORD);
mysql_select_db("news", $con);
$postid = $_GET['id'];
$sql = "select `post_content`,`post_date`,`post_title` from `news_posts` where id = {$postid} limit 1";
$res = mysql_query($sql);
$data = mysql_fetch_array($res);
$content = str_replace('\n','</p><p></p><p>',$data['post_content']);
$content = "<p>".$content."<p>";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>
  孩子爱独处 就请别逼他_育儿资讯</title>
<meta name="description" content="每个宝贝在出生之时就已经拥有自己的性格特色，就像不同星座，宝贝的性格特点一样，不同成长环境和不同遗传基因也会导致宝贝们在性格上的特点不一样。有些孩子热情大方，阳光自信；相反，有些孩子胆小内向，不善于与人交流。" />
<meta name="keywords" content="3-6岁, 早期教育, 育儿知识, 行为性格, " />
<!-- RSS -->
<link rel="alternate" type="application/rss+xml" title="育儿资讯 RSS Feed" href="http://news.ci123.com/feed" />
<!-- RPC -->
<link rel="pingback" href="http://news.ci123.com/xmlrpc.php" />
<!-- styles -->
<link type="text/css" rel="stylesheet" href="http://news.ci123.com/styles/basic.css" />
<link type="text/css" rel="stylesheet" href="http://news.ci123.com/styles/styles_v3.css?t=20151106" />
<link href="http://file2.ci123.com/ast/loginface/style5.css" rel="stylesheet" type="text/css" />

<!-- JS -->
<script src="http://news.ci123.com/js/jquery-1.7.1.min.js" type="text/javascript"></script>
<script src="http://news.ci123.com/js/global.js" type="text/javascript"></script>
<script src="http://file2.ci123.com/ast/loginface/cookielogin10.js" language="javascript"></script>
<script type="text/javascript" language="JavaScript" src="http://user.ci123.com/js/auth.js"></script>

<script language="javascript" type="text/javascript" src="http://shop.ci123.com/open/ui/scrolltotop/jquery.scrolltotop.js"></script>
<link rel="stylesheet" type="text/css" href="http://shop.ci123.com/open/ui/scrolltotop/jquery.scrolltotop.css">
<script type="text/javascript" language="JavaScript" src="http://tc.ci123.com/js/tcjs.php"></script>

</head>
<body>
		<?php include_once("global/meta.php");?>
				<div class="main clearfix">
					<div class="l">
						<div class="breadCrumbs">
								  当前位置：<a href="http://news.ci123.com">资讯首页 </a>
							 &gt; <a href="http://news.ci123.com/category/news" title="查看 育儿动态 中的全部文章" rel="category tag">育儿动态</a>							 &gt; <a href='http://news.ci123.com/article/<?php echo $postid;?>.html'>孩子爱独处 就请别逼他</a>													</div>

						
						<div class="post" id="post">
							<h1 class="postTitle"><?php echo $data['post_title'];?></h1>
							<div class="postInfo">
								<span>发布于<a href="http://news.ci123.com/article/77791.html"><?php echo $data['post_date'];?></a></span>
								<span>标签：<a href="http://news.ci123.com/article/tag/3-6%e5%b2%81" rel="tag nofollow">3-6岁</a>, <a href="http://news.ci123.com/article/tag/%e6%97%a9%e6%9c%9f%e6%95%99%e8%82%b2" rel="tag nofollow">早期教育</a>, <a href="http://news.ci123.com/article/tag/%e8%82%b2%e5%84%bf%e7%9f%a5%e8%af%86" rel="tag nofollow">育儿知识</a>, <a href="http://news.ci123.com/article/tag/%e8%a1%8c%e4%b8%ba%e6%80%a7%e6%a0%bc" rel="tag nofollow">行为性格</a></span>
								<span>作者：李沁</span>
							</div>
							<div class="entry group">
								<?php echo nl2br($content);?>
							<p class="tips mgt10">(原创作品，版权所有。未经授权，不得转载！)</p>							
							</div>
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
										妈妈购<br />为宝宝发现最好的
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
														</ul>
						</div>
					</div>
					<div class="r">
							<div class="hot">
			<h2>图说</h2>
	<ul class="tushuo">
					<li>
				<div class="clearfix">
					<a href="http://news.ci123.com/article/77335.html" title="火腿不能吃？做小肠仔"><img class="img" src="http://news.ci123.com/uploads/20151105/upload_4zGEO_fb4b822d5b2b40df" /></a>
					<div class="info">
						<h3><a href="http://news.ci123.com/article/77335.html" title="火腿不能吃？做小肠仔">火腿不能吃？做小肠仔</a></h3>
						<div>最近关于火腿致癌的新闻传得沸沸扬扬，如果你不放心，就做小肠仔吧！</div>
					</div>
				</div>
			</li>
					<li>
				<div class="clearfix">
					<a href="http://news.ci123.com/article/77844.html" title="2次流产她这样留住BB"><img class="img" src="http://news.ci123.com/uploads/20151105/upload_rsXeg_9c479c455677fc52" /></a>
					<div class="info">
						<h3><a href="http://news.ci123.com/article/77844.html" title="2次流产她这样留住BB">2次流产她这样留住BB</a></h3>
						<div>在国外，有位女性两次怀孕都不幸流产，而她却不想将孩子们忘怀。</div>
					</div>
				</div>
			</li>
					<li>
				<div class="clearfix">
					<a href="http://news.ci123.com/article/77503.html" title="明星老婆因会晒娃爆红"><img class="img" src="http://news.ci123.com/uploads/20151102/upload_y0LAQ_e7a334732a12a010" /></a>
					<div class="info">
						<h3><a href="http://news.ci123.com/article/77503.html" title="明星老婆因会晒娃爆红">明星老婆因会晒娃爆红</a></h3>
						<div>今天让我们一起来看美国辣妈HilariaThomas，她在INS上超级红。</div>
					</div>
				</div>
			</li>
					<li>
				<div class="clearfix">
					<a href="http://news.ci123.com/article/77170.html" title="BB销魂睡姿一个赛一个"><img class="img" src="http://news.ci123.com/uploads/20151102/upload_VcJn7_06a29bfa22cfb7e0" /></a>
					<div class="info">
						<h3><a href="http://news.ci123.com/article/77170.html" title="BB销魂睡姿一个赛一个">BB销魂睡姿一个赛一个</a></h3>
						<div>孩子睡了，世界安静下来。大家快来比一比，看看哪位睡姿最销魂？</div>
					</div>
				</div>
			</li>
					<li>
				<div class="clearfix">
					<a href="http://news.ci123.com/article/76613.html" title="多造型小公举编发任选"><img class="img" src="http://news.ci123.com/uploads/20151103/upload_S6kcA_2079d5939d912104" /></a>
					<div class="info">
						<h3><a href="http://news.ci123.com/article/76613.html" title="多造型小公举编发任选">多造型小公举编发任选</a></h3>
						<div>家有女儿，公举养成计划需趁早。一个漂亮的发型可以给她增色不少呢~</div>
					</div>
				</div>
			</li>
					<li>
				<div class="clearfix">
					<a href="http://news.ci123.com/article/77072.html" title="摄影包晒BB新招Get√"><img class="img" src="http://news.ci123.com/uploads/20151104/upload_4MCdZ_39f8540ca7511bb6" /></a>
					<div class="info">
						<h3><a href="http://news.ci123.com/article/77072.html" title="摄影包晒BB新招Get√">摄影包晒BB新招Get√</a></h3>
						<div>最近很流行摄影包晒娃，可以让宝宝重温在妈妈腹中的美好时光。</div>
					</div>
				</div>
			</li>
			</ul>
	</div>
    <div class="hot mgt10">
        <h2>今日论坛热帖</h2>
        <ul class="hotList">
        <?php foreach($bbsdata as $v) { ?>
            <li class="clearfix"><a href="http://bbs.ci123.com/post/<?php echo $v->id;?>.html" target="_blank" rel="bookmark" title="<?php echo $v->title;?>" class="fl"><?php echo $v->title;?></a><span class="fr n"><?php echo $v->clicknum;?></span></li>
        <?php } ?>
        </ul>
    </div>
    <div class="hot mgt10">
        <h2>热门文章</h2>
        <ul class="hotList">
            <?php
            ?>
        </ul>
    </div>
    <div class="hot mgt10">
        <h2>热门词条</h2>
        <ul class="hot mgt10">
        <?php foreach($baikedata as $v){?>
        <?php
            $color = "ffb568";
            if($v->color == "blue"){
                    $color = "8abde8";
            }
        ?>
        <a style="text-decoration: none; color:#ffffff;padding: 1px 6px 2px; line-height: 24px;font-size: 14px;background-color: #<?php echo $color;?>;white-space: nowrap;margin-right: 3px;" href="<?php echo $v->url;?>"><?php echo $v->word;?></a>
        <?php }?>
        </ul>
    </div>
<!--	<div class="hot mgt10">
		<script>
		var mediav_ad_pub = 'u6yDsN_1031979';
		var mediav_ad_width = '250';
		var mediav_ad_height = '250';
		</script>
		<script type="text/javascript" language="javascript" charset="utf-8"  src="http://static.mediav.com/js/mvf_g2.js"></script>
	</div>-->

					</div>
				</div>
<?php include_once("global/footer.php");?>
</body>
</html>



