<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!--qindc-->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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
<?php
	if (is_home())
	{
	//	echo '<meta name="baidu-site-verification" content="50nDiWeLpQ" />';
		echo '<meta name="baidu-site-verification" content="M4064PycTV" />';
	}
?>
<!-- RSS -->
<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
<!-- RPC -->
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<!-- styles -->
<link type="text/css" rel="stylesheet" href="<?=bloginfo('url')?>/styles/basic.css" />
<link type="text/css" rel="stylesheet" href="<?=bloginfo('url')?>/styles/styles_v3.css?t=20151106" />
<link href="http://file2.ci123.com/ast/loginface/style5.css" rel="stylesheet" type="text/css" />

<!-- JS -->
<script src="<?=bloginfo('url')?>/js/jquery-1.7.1.min.js" type="text/javascript"></script>
<script src="<?=bloginfo('url')?>/js/global.js" type="text/javascript"></script>
<script src="http://file2.ci123.com/ast/loginface/cookielogin10.js" language="javascript"></script>
<script type="text/javascript" language="JavaScript" src="http://user.ci123.com/js/auth.js"></script>

<script language="javascript" type="text/javascript" src="http://shop.ci123.com/open/ui/scrolltotop/jquery.scrolltotop.js"></script>
<link rel="stylesheet" type="text/css" href="http://shop.ci123.com/open/ui/scrolltotop/jquery.scrolltotop.css">
<script type="text/javascript" language="JavaScript" src="http://tc.ci123.com/js/tcjs.php"></script>

</head>
<body>
<?php if(is_home()){?>
<div style="margin:0 auto;text-align:center">
<script type="text/javascript">LoadAdJs(60);</script>
</div>
<?php }else if(is_single()){?>
<div style="margin:0 auto;text-align:center">
<script type="text/javascript">LoadAdJs(57);</script>
</div>
<?php }?>
<div id="global_nav">
	<div id="nav">
		<div class="ci123_logo">
			<?php include_once("inc/header.php");?>
			<?php include_once("inc/top_head.php");?>
			<?php include_once("inc/nav.php");?>
		</div><!--/ci123_logo-->
	</div><!--/nav-->
</div>
