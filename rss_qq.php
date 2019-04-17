<?php
echo(microtime());
include_once("cron/inc/config.php");
//include_once(ABSPATH."wp-content/themes/news_v3/functions.php");
$photosData = unserialize(file_get_contents('/opt/ci123/www/html/news/wp-content/themes/news_v3/glbRightPhotosDatanew.cache'));
$bbsdata = json_decode(file_get_contents("/opt/ci123/www/html/news/wp-content/themes/news_v3/bbsRpc.cache"));
$baikedata = json_decode(file_get_contents("/opt/ci123/www/html/news/wp-content/themes/news_v3/keywords.cache"));
$hot_articles = json_decode(file_get_contents("/opt/ci123/www/html/news/cron/hot_articles.cache"),true);
echo"<br>";echo(microtime());
$con = mysql_connect(DB_HOST,DB_USERNAME,DB_PASSWORD);
$DB = mysql_select_db("news", $con);
$postid = $_GET['id'];
$categorys = array(1,24,45,109,110);
$cat_detail = array(
	'event'	=> '事件播报',
	'news'	=> '育儿动态',
	'poto'	=> '图片新闻',
	'video'	=> '视频报道',
);
$sql = "select `post_author`,`post_content`,`post_date`,`post_title` from `news_posts` where id = {$postid} limit 1";
$data = getRow($sql);
echo"<br>";echo(microtime());
//处理内容
$data['post_content'] = str_replace(array('<p>','</p>'),array("\n\r","\n\r"),$data['post_content']);
$data['post_content'] = preg_replace("/[\n\r]/i",'</p><p>',$data['post_content']);
$data['post_content'] = "<p>".$data['post_content'];
echo"<br>";echo(microtime());
//处理日期
$data['post_date'] = substr($data['post_date'],0,16);
//获取关键内容
$tmp = explode(' ',$data['post_content']);
$description = trim(strip_tags($tmp[0]));
//获取作者信息
$sql = "select `meta_value` from `news_usermeta` where `user_id` = {$data['post_author']} and `meta_key` in ('last_name','first_name') limit 2";
$tmp = getRows($sql);
$user = $tmp[1]['meta_value'].$tmp[0]['meta_value'];
//获取关键词
$sql = "select `term_taxonomy_id` from `news_term_relationships` where object_id = {$postid} order by `object_id` asc limit 10";
$tmp = getRows($sql);
echo"<br>";echo(microtime());
foreach($tmp as $k=>$v){
	$sql = "select `term_id`,`name`,`slug`,`term_id` from `news_terms` where term_id  = {$v['term_taxonomy_id']}  limit 1";
	$tmp_tags = getRow($sql);
	if(in_array($tmp_tags['term_id'],$categorys)){
		$cat[] = $tmp_tags['name'];
		$cat[] = $tmp_tags['slug'];
		$cat[] = $tmp_tags['term_id'];
		continue;
	}
	$tag['name'][] = $tmp_tags['name']; 
	$tag['id'][] = $tmp_tags['term_id']; 
	$tag['href'][] = '<a href="http://news.ci123.com/article/tag/'.$tmp_tags['name'].'" rel="tag nofollow">'.$tmp_tags['name'].'</a>'; 
}
$tags['id'] = implode(",", $tag['id']);
$tags['name'] = implode(",", $tag['name']);
$tags['href'] = implode(", ", $tag['href']);
//获取相关文章
$sql = "select  `ID` ,  `post_title` ,  `post_content`,`guid` FROM  news_posts INNER JOIN news_term_relationships ON ( news_posts.`ID` = news_term_relationships.`object_id` )  INNER JOIN news_term_taxonomy ON ( news_term_relationships.`term_taxonomy_id` = news_term_taxonomy.`term_taxonomy_id` ) WHERE 1 =1 AND news_term_taxonomy.`taxonomy` =  'post_tag' AND news_term_taxonomy.`term_id` in (".$tags['id'].") AND news_posts.`post_status` =  'publish' GROUP BY news_posts.`ID` ORDER BY  `post_date` DESC  LIMIT 0,5";
//$now = date("Y-m-d H:i:s");
//$sql = "select `ID` ,  `post_title` ,  `post_content`  from `news_posts` where post_type='post' and post_status='publish' and post_date<'{$now}' order by ID desc limit 5";
echo"<br>";echo(microtime());
$relate = getRows($sql);
echo"<br>";echo(microtime());
foreach($relate as $k=>$v){
	preg_match ("<img.*src=[\"](.*?)[\"].*?>",$v['post_content'],$match);
	$relate[$k]['img'] = str_replace(".jpeg","-150x150.jpeg",$match[1]);
}
echo"<br>";echo(microtime());

function getRow($sql){	//取出一条数据
	global $con;
	$query = mysql_query($sql,$con);
	$data = mysql_fetch_array($query,MYSQL_ASSOC);
	return $data?$data:array();
}
function getRows($sql){		//取出多条数据
	global $con;
	$query = mysql_query($sql,$con);
	$data = array();
	while($row = mysql_fetch_array($query,MYSQL_ASSOC)){
		$data[] = $row;
	}
	return $data;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $data['post_title'];?></title>
<meta name="description" content="<?php echo $description;?>" />
<meta name="keywords" content="<?php echo $tags['name'];?>" />
<!-- RSS -->
<link rel="alternate" type="application/rss+xml" title="育儿资讯 RSS Feed" href="http://news.ci123.com/feed" />
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
	<div id="nav_menu3">
		<s class="l"></s>
		<ul>
			<li><a href="http://news.ci123.com/" >资讯首页</a></li>
			<?php foreach($cat_detail as $k=>$v){?>
			<li><a href="http://news.ci123.com/category/<?php echo $k;?>" <?php if($k==$cat[1]){echo 'class="on"';}?>><?php echo $v;?></a></li>
			<?php }?>
		</ul>
		<s class="r"></s>
	</div>
		</div><!--/ci123_logo-->
	</div><!--/nav-->
</div>
<style type="text/css">
.post .entry p { text-indent: 2em; }
</style>
<div class="main clearfix">
	<div class="l">
		<div class="breadCrumbs">
					当前位置：<a href="http://news.ci123.com">资讯首页 </a>
				&gt; <a href="http://news.ci123.com/category/<?php echo $cat[1];?>" title="查看 <?php echo $cat[0];?> 中的全部文章" rel="category tag"><?php echo $cat[0];?></a>							 &gt; <a href='http://news.ci123.com/article/<?php echo $postid;?>.html'><?php echo $data['post_title'];?></a>													</div>
		<div class="post" id="post">
			<h1 class="postTitle"><?php echo $data['post_title'];?></h1>
			<div class="postInfo">
				<span>发布于<a href="http://news.ci123.com/article/<?php echo $postid;?>.html"><?php echo $data['post_date'];?></a></span>
				<span>标签：<?php echo $tags['href'];?></span> 
				<span>作者：<?php echo $user;?></span>
			</div>
			<div class="entry group">
				<?php echo $data['post_content'];?>
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
				<?php if(!$relate){?>
					<li>没有相关文章</li>
				<?php }?>
				<?php foreach($relate as $k=>$v){?>
				<li>
					<a rel="bookmark" title="<?php echo $v['post_title'];?>" href="http://news.ci123.com/article/<?php echo $v['ID'];?>.html">
					<img src="<?php echo $v['img'];?>" alt="<?php echo $v['post_title'];?>" width="96" height="96" />
					<p><?php echo $v['post_title'];?></p>
					</a>
				</li>
				<?php }?>
			</ul>
		</div>
	</div>
	<div class="r">
		<div class="hot">
			<h2>图说</h2>
			<ul class="tushuo">
				<?php for ($i = 0; $i < 6; $i++) { ?>
					<li>
						<div class="clearfix">
							<a href="<?php echo $photosData['links'][$i];?>" title="<?php echo $photosData['titles'][$i];?>"><img class="img" src="<?=$photosData['imgs'][$i]?>" /></a>
							<div class="info">
								<h3><a href="<?php echo $photosData['links'][$i];?>" title="<?php echo $photosData['titles'][$i];?>"><?php echo $photosData['titles'][$i];?></a></h3>
								<div><?php echo $photosData['texts'][$i];?></div>
							</div>
						</div>
					</li>
				<?php } ?>
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
					foreach ($hot_articles[$cat[2]] as $post){?>
						<li><a href="http://news.ci123.com/article/<?php echo $post['ID'];?>.html" rel="bookmark" title="<?php echo $post['post_title'];?>" ><?php echo $post['post_title'];?></a></li>
					<?php }?>
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
	</div>
</div>
<?php include_once("global/footer.php");?>
</body>
</html>
<?php echo microtime();?>

