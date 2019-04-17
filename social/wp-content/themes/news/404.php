<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"/>
    <meta name="description" content="404" /> 
    <meta name="keywords" content="404" />
    <!--meta http-equiv="refresh" content="10; url='http://plan.ci123.com/zaojiao/?f=404'" /-->
	<title>页面不存在 - 育儿资讯</title>
	<style>
		body{margin:0; padding:0;background-color:#eee;overflow: hidden;}
		.buging{width: 870px;height: 275px;margin: 100px auto 0; border-radius:10px;font-size:14px; background-color:#fff;overflow: hidden;font-family:"\5FAE\8F6F\96C5\9ED1"/*yahei*/,sans-serif;/*for mac*/}
		.buging .buging-wrap{width:530px;height:205px;margin:50px auto 0;background:url("<?=bloginfo('url')?>/images/404.png") no-repeat;position:relative;overflow: hidden;}
		.buging .buging-con{margin:0 0 0 250px;}
		.buging .title{font-size:22px;}
		.footer { width: 870px; margin: 20px auto; }
		.footer p { color: #333; text-align: center; font: 12px/1.5em tahoma,arial,sans-serif; }
		.footer p a { color: #333; }
		a { color: #357FC6; text-decoration: none; }
		a:hover { text-decoration: underline; }
	</style>
</head>
<body>
	<div class="buging">
        <div class="buging-wrap">
            <div class="buging-con">
                <p class="title">抱歉，您跑到火星了</p>
                <p><a href="http://news.ci123.com/?f=404">点此回到地球 &gt;&gt;</a></p>
				<p><a href="javascript:goTo(-1);">飞往上一个页面 &gt;&gt;</a></p>
            </div>
        </div>
    </div>
	<div class="footer">
		<p>Copyright &copy; <?=date('Y')?>&nbsp;&nbsp;育儿网&nbsp;&nbsp;All Rights Reserved&nbsp;&nbsp;<a href="http://www.miibeian.gov.cn/" target="_blank">苏ICP备09013109号</a></p>
		<div style="display:none;">
			<script src="http://s15.cnzz.com/stat.php?id=4661801&web_id=4661801" language="JavaScript"></script>
		</div>
	</div>
	<script type="text/javascript">
		function goTo(i)
		{
			window.history.go(i);
		}
	</script>
</body>
</html>