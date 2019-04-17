$(function(){
	/**
	 * 顶部轮播
	 */
	 /*
	$(".topSlider .slide-image a").click(function(){
		$.ajax({
			type: "POST",
			url: "http://news.ci123.com/click.php?rnd=" + Math.random(),
			data: { from: "topSlider", title: $(this).find('.caption').text(), link: $(this).attr('href') }
		});
	});
	*/

	/**
	 * 全局右侧热门文章
	 */
	 /*
	$(".hot .hotList a").click(function(e){
		e.preventDefault();
		var sTitle = $(this).text();
		var sLink = $(this).attr('href');
		$.ajax({
			type: "POST",
			url: "http://news.ci123.com/click.php?rnd=" + Math.random(),
			data: { from: "glbRightHotPost", title: sTitle, link: sLink },
			success: function(d)
			{
				window.location = sLink;
			}
		});
	});
	*/

	/**
	 * 全局右侧图片
	 */
	 /*
	$(".hot .photo a.p").click(function(e){
		e.preventDefault();
		var sTitle = $(this).parent().find('h3 a').text();
		var sLink = $(this).attr('href');
		$.ajax({
			type: "POST",
			url: "http://news.ci123.com/click.php?rnd=" + Math.random(),
			data: { from: "glbRightHotPhoto", title: sTitle, link: sLink },
			success: function(d)
			{
				window.location = sLink;
			}
		});
	});
	*/

	/**
	 * 全局右侧图片
	 */
	 /*
	$(".hot .photo h3 a").click(function(e){
		e.preventDefault();
		var sTitle = $(this).text();
		var sLink = $(this).attr('href');
		$.ajax({
			type: "POST",
			url: "http://news.ci123.com/click.php?rnd=" + Math.random(),
			data: { from: "glbRightHotPhoto", title: sTitle, link: sLink },
			success: function(d)
			{
				window.location = sLink;
			}
		});
	});
	*/

	/**
	 * 每日头条图片
	 */
	$("#home .tl a").click(function(e){
		e.preventDefault();
		var sTitle = $(this).attr('title');
		var sLink = $(this).attr('href');
		$.ajax({
			type: "POST",
			url: "http://news.ci123.com/click.php?rnd=" + Math.random(),
			data: { from: "homeToutiaoPic", title: sTitle, link: sLink },
			success: function(d)
			{
				window.location = sLink;
			}
		});
	});

	/**
	 * 每日头条文章
	 */
	$("#home .tr a").click(function(e){
		e.preventDefault();
		var sTitle = $(this).text();
		var sLink = $(this).attr('href');
		$.ajax({
			type: "POST",
			url: "http://news.ci123.com/click.php?rnd=" + Math.random(),
			data: { from: "homeToutiaoText", title: sTitle, link: sLink },
			success: function(d)
			{
				window.location = sLink;
			}
		});
	});

	/**
	 * 图说
	 */
	$(".tushuo a").click(function(e){
		e.preventDefault();
		var sTitle = $(this).attr('title');
		var sLink = $(this).attr('href');
		$.ajax({
			type: "POST",
			url: "http://news.ci123.com/click.php?rnd=" + Math.random(),
			data: { from: "tushuo", title: sTitle, link: sLink },
			success: function(d)
			{
				window.location = sLink;
			}
		});
	});

	/**
	 * 标签组
	 */
	$(".board .group .h2 a").click(function(e){
		e.preventDefault();
		var sTitle = $(this).text();
		var sLink = $(this).attr('href');
		$.ajax({
			type: "POST",
			url: "http://news.ci123.com/click.php?rnd=" + Math.random(),
			data: { from: "groupTitle", title: sTitle, link: sLink },
			success: function(d)
			{
				window.location = sLink;
			}
		});
	});

	/**
	 * 标签组头条图片
	 */
	$(".board .group h3 a").click(function(e){
		e.preventDefault();
		var sTitle = $(this).text();
		var sLink = $(this).attr('href');
		$.ajax({
			type: "POST",
			url: "http://news.ci123.com/click.php?rnd=" + Math.random(),
			data: { from: "groupToutiaoPic", title: sTitle, link: sLink },
			success: function(d)
			{
				window.location = sLink;
			}
		});
	});

	/**
	 * 标签组头条文章
	 */
	$(".board .group .other a").click(function(e){
		e.preventDefault();
		var sTitle = $(this).text();
		var sLink = $(this).attr('href');
		$.ajax({
			type: "POST",
			url: "http://news.ci123.com/click.php?rnd=" + Math.random(),
			data: { from: "groupToutiaoText", title: sTitle, link: sLink },
			success: function(d)
			{
				window.location = sLink;
			}
		});
	});
});
