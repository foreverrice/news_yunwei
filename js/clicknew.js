$(function(){
	
	/**
	 * 每日头条大图以及标题
	 */
	 $(".b-img").click(function(e){
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
	$(".teach a").click(function(e){
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
	 * 每日右侧头条文章
	 */
	
	$(".knowledge .fright  a").click(function(e){
		e.preventDefault();
		var sTitle = $(this).attr('title');
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
	 * 新首页图说
	 */
	$(".picnews .r a").click(function(e){
		e.preventDefault();
		var sTitle = $(this).text();
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
	 * 老首页图说
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
	 * 育儿视点
	 */
	 $("#yuershidian a").click(function(e){
		e.preventDefault();
		var sTitle = $(this).attr('title');
		var sLink = $(this).attr('href');
		$.ajax({
			type: "POST",
			url: "http://news.ci123.com/click.php?rnd=" + Math.random(),
			data: { from: "yuershidian", title: sTitle, link: sLink },
			success: function(d)
			{
				window.location = sLink;
			}
		});
	});



	/**
	 * 标签组头条标题
	 */
	$(".olmother .fl .r a").click(function(e){
		e.preventDefault();
		var sTitle = $(this).attr('title');
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
	 * 标签组头条图片
	 */
	$(".groupimg").click(function(e){
		e.preventDefault();
		var sTitle = $(this).attr('title');
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
	 * 标签组其它文章
	 */
	$(".olmother .fl dl dd a").click(function(e){
		e.preventDefault();
		var sTitle = $(this).attr('title');
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
	/**
	 * 视频
	 */

	 $(".video ul li div a").click(function(e){
		e.preventDefault();
		var sTitle = $(this).attr('title');
		var sLink = $(this).attr('href');
		$.ajax({
			type: "POST",
			url: "http://news.ci123.com/click.php?rnd=" + Math.random(),
			data: { from: "video", title: sTitle, link: sLink },
			success: function(d)
			{
				window.location = sLink;
			}
		});
	});
	
});
