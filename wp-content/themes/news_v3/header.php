<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="x-ua-compatible" content="ie=7" />
<title>
<?php
	if (is_home())
	{
		echo "育儿资讯_育儿网";
	}
	else if (is_single())
	{
		wp_title('');
		echo("_");
		bloginfo('name');
	}
	else if (is_tag())
	{
		wp_title('');
		echo("_");
		bloginfo('name');
	}
	else if (is_search())
	{
		the_search_query();
		echo("_");
		bloginfo('name');
	}
	else
	{
		wp_title('');
		echo("_");
		bloginfo('name');
	}
?>
</title>
<?php
$options = get_option('classic_options');
$dis = $options['description'];
$key = $options['keywords'];
if (is_home())
{
	$keywords = "育儿新闻,母婴新闻,育儿动态";
	$description = "育儿网新闻频道为全球华人提供最新最快最详实的育儿资讯、热点新闻、育儿动态、图片新闻。";
}
elseif (is_page())
{
	$description = $dis;
	$keywords = $key ;
}
elseif (is_category('事件播报'))
{
	$keywords = "国内外新闻，早期教育";
	$description = "为您报道国内外最新的育儿、母婴类新闻及热点事件。";
}
elseif (is_category('育儿动态'))
{
	$keywords = "儿童健康，宝宝智力开发";
	$description = "为您提供国内育儿方面的各种知识，解读国内外最新的育儿知识。";
}
elseif (is_category('图片新闻'))
{
	$keywords = "宝宝图片，国内外奇事异闻";
	$description = "为您捕捉最新最清晰的新闻图片以及育儿信息。";
}
elseif (is_single())
{
	if ($post->post_excerpt)
	{
       	$description = $post->post_excerpt;
    }
	else
	{
       	$description = mb_substr(strip_tags($post->post_content), 0, 120);
    }
    $keywords = "";
    $tags = wp_get_post_tags($post->ID);
    foreach ($tags as $tag)
	{
		if(strstr($tag->name,'【')){
			continue;
		}
		$keywords = $keywords . $tag->name . ", ";
    }
}
?>
<meta name="description" content="<?=$description?>" />
<meta name="keywords" content="<?=$keywords?>" />
<!-- RSS -->
<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
<!-- RPC -->
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<!-- styles -->
<link rel="stylesheet" href="<?=bloginfo('url')?>/styles/basic.css" type="text/css" />
<link rel="stylesheet" href="<?=bloginfo('url')?>/styles/styles_v3.css?t=20150724" type="text/css" />
<!-- JS -->
<script src="<?=bloginfo('url')?>/js/jquery-1.7.2.min.js" type="text/javascript"></script>
<script src="<?=bloginfo('url')?>/js/global.js" type="text/javascript"></script>
<script language="javascript" type="text/javascript" src="http://shop.ci123.com/open/ui/scrolltotop/jquery.scrolltotop.js"></script>
<link rel="stylesheet" type="text/css" href="http://shop.ci123.com/open/ui/scrolltotop/jquery.scrolltotop.css" />
<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>

<script type="text/javascript">window.onerror = function(){return true;}</script>
<script type="text/javascript">
$(function(){
	$('.cat-item li').hover(function() {
		$('ul', this).slideDown(300);
	}, function() {
		$('ul', this).slideUp(300);
	});
});
</script>
</head>
<body>
<div class="glbTop">
	<div class="t">
		<ul class="clearfix">
			<li><a href="http://www.ci123.com/">育儿网首页</a></li><li class="s">|</li>
			<li><a href="http://www.ci123.com/index1.html">父母学堂</a></li><li class="s">|</li>
			<li><a href="http://bbs.ci123.com/">育儿论坛</a></li><li class="s">|</li>
			<li><a href="http://baobao.ci123.com/">宝宝主页</a></li><li class="s">|</li>
			<li><a href="http://blog.ci123.com/">育儿博客</a></li><li class="s">|</li>
			<li><a href="http://ask.ci123.com/">育儿问答</a></li><li class="s">|</li>
			<li><a href="http://tree.ci123.com/">许愿树</a></li><li class="s">|</li>
			<li><a href="http://rs.ci123.com/">亲子资源</a></li><li class="s">|</li>
			<li><a href="http://www.ci123.com/baodian/">育儿宝典</a></li><li class="s">|</li>
			<li><a href="http://kaixintree.ci123.com/index.php">开心俱乐部</a></li><li class="s">|</li>
			<li><a href="http://plan.ci123.com/zaojiao/?f=news.topbar.0.0">早教帮</a></li>
			<li class="l" onmousemove="mopen('navbox')" onmouseout="mclosetime()"><span>网站导航</span><i id="arr"></i></li>
		</ul>
		<script type="text/javascript">
		{
			var timeout = 500;
			var closetimer = 0;
			var ddmenuitem = 0;
			function mopen(id)
			{
				mcancelclosetime();
				if(ddmenuitem) ddmenuitem.style.visibility = 'hidden';
				ddmenuitem = document.getElementById(id);
				ddmenuitem.style.visibility = 'visible';
				document.getElementById("arr").style.backgroundPosition='0 -85px';
			}
			function mclose()
			{
				if(ddmenuitem) ddmenuitem.style.visibility = 'hidden';
				document.getElementById("arr").style.backgroundPosition='0 -93px';
			}
			function mclosetime()
			{
				closetimer = window.setTimeout(mclose, timeout);
			}
			function mcancelclosetime()
			{
				if(closetimer)
				{
					window.clearTimeout(closetimer);
					closetimer = null;
				}
			}
			document.onclick = mclose;
		}
		</script>
		<div class="navbox" id="navbox" onmouseover="mcancelclosetime()" onmouseout="mclosetime()">
			<div class="tit">知识阅读</div>
			<div><a href="http://www.ci123.com/index1.html">父母学堂</a><a href="http://ask.ci123.com/">育儿问答</a><a href="http://www.ci123.com/special/piont">育儿视点</a><a href="http://www.ci123.com/baodian/">育儿宝典</a></div>
			<div class="tit">互动社区</div>
			<div><a href="http://bbs.ci123.com/">育儿论坛</a><a href="http://baobao.ci123.com/">宝宝主页</a><a href="http://blog.ci123.com/">育儿博客</a><a href="http://shop.ci123.com/?lps=1369117390.19.43.2">妈妈购</a></div>
			<div class="tit">免费资源</div>
			<div><a href="http://rs.ci123.com/">亲子资源</a><a href="http://.ci123.com/brand">母婴产品</a><a href="http://shiyong.ci123.com/">商品试用</a><a href="http://kaixintree.ci123.com/index.php">开心俱乐部</a></div>
		</div>
	</div>
	<div class="c clearfix">
		<a class="logo" href="<?=bloginfo('home')?>" title="育儿资讯"></a>
		<div class="search">
			<form method="GET" id="searchform" class="search" action="<?=bloginfo('url')?>">
				<input type="text" value="" name="s" id="s" />
				<input type="submit" value="" class="searchbutton" id="search_submit" />
			</form>
		</div>
	</div>
	<div class="b">
		<div class="bCont">
			<ul class="nav clearfix">
				
				<li class="<?php if (is_home()) { echo "current-cat "; } ?>">
					<a href="http://news.ci123.com/">资讯首页<i></i></a>
				</li>
				<li class="cat-item <?php if ($cat == 1) { echo "current-cat "; } ?>"><a href="http://news.ci123.com/category/event">事件播报<i></i></a>
				</li>
	
				<li class="cat-item <?php if ($cat == 24) { echo "current-cat "; } ?>"><a href="http://news.ci123.com/category/news">育儿动态<i></i></a>
				</li>

				<li class="cat-item <?php if ($cat == 45) { echo "current-cat "; } ?>"><a href="http://news.ci123.com/category/poto">图片新闻<i></i></a>
				</li>

				<li class="cat-item <?php if ($cat == 109) { echo "current-cat "; } ?>"><a href="http://news.ci123.com/category/video">视频报道<i></i></a>
				</li>
			</ul>
		</div>
	</div>
</div>
<script type="text/javascript">
$(function(){
	$(".glbTop .b .bCont .nav li").hover(function(){
		$(this).addClass('hover');
	}, function(){
		$(this).removeClass('hover');
	});
});
</script>
