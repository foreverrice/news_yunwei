<div id="nav_small">
	<ul>
		<li class="l"><a href="http://www.ci123.com/">首页</a></li>
		<li class="s">|</li>
		<li class="on"><a href="http://news.ci123.com/">育儿资讯</a></li>
		<li class="s">|</li>
		<li><a href="http://www.ci123.com/index1.html">父母学堂</a></li>
		<li class="s">|</li>
		<li><a href="http://bbs.ci123.com/">育儿论坛</a></li>
		<li class="s">|</li>
		<li><a href="http://baobao.ci123.com/">宝宝主页</a></li>
		<li class="s">|</li>
		<li><a href="http://blog.ci123.com/">育儿博客</a></li>
		<li class="s">|</li>
		<li><a href="http://ask.ci123.com/">育儿问答</a></li>
		<li class="s">|</li>
		<li><a href="http://rs.ci123.com/">亲子资源</a></li>
		<li class="s">|</li>
		<li><a href="http://www.ci123.com/baodian">育儿宝典</a></li>
		<li class="s">|</li>
		<li><a href="http://qq.ci123.com/">育儿圈圈</a></li>
		<li class="s">|</li>
		<li><a href="http://info.ci123.com/brand">母婴产品</a></li>
		<li class="s">|</li>
		<li><a href="http://kaixintree.ci123.com/index.php" title="开心俱乐部">开心俱乐部</a></li>
	</ul>
</div>

<?php
	$post_cate = get_the_category();
	$post_cate_id = $post_cate[0]->cat_ID;
?>

<div id="nav_menu3">
	<s class="l"></s>
	<ul>
		<li><a href="http://news.ci123.com/" <?php if (is_home()){?>class="on"<?php }?>>资讯首页</a></li>
		<li><a href="http://news.ci123.com/category/event" <?php if ((!is_home()) && (($cat == 1) || ($post_cate_id == 1))){?>class="on"<?php }?>>事件播报</a></li>
		<li><a href="http://news.ci123.com/category/news" <?php if ((!is_home()) && (($cat == 24) || ($post_cate_id == 24))){?>class="on"<?php }?>>育儿动态</a></li>
		<li><a href="http://news.ci123.com/category/poto" <?php if ((!is_home()) && (($cat == 45) || ($post_cate_id == 45))){?>class="on"<?php }?>>图片新闻</a></li>
		<li><a href="http://news.ci123.com/category/video" <?php if ((!is_home()) && (($cat == 109) || ($post_cate_id == 109))){?>class="on"<?php }?>>视频报道</a></li>
	</ul>
	<s class="r"></s>
</div>
