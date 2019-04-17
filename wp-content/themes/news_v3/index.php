<?php include_once('heade_new.php'); ?>

<div class="index">
	<div class="clearfix mgt10">
		<div class="knowledge clearfix">
			<?php include_once('homeToutiao_new.php'); ?>
		</div>
		<div class="view" id="yuershidian">
			<?php include_once('yuershidian.php'); ?>
		</div><!--/view-->
	</div>
	<script type="text/javascript" language="JavaScript" src="http://tc.ci123.com/js/tcjs.php"></script>
	<div style="margin-bottom:10px;">
		<script type="text/javascript">LoadAdJs(248);</script>
	</div>
	<div class="total">
		<div class="left">
			<?php include_once('homeGroup_new.php'); ?>
		</div><!--/left-->
		<div class="right">
			<?php include_once('sidebar_new.php'); ?>
		</div><!--/right-->
	</div><!--/total-->
</div><!--/index-->
<script type="text/javascript">
	$(function() {
		
		$(".right dl dd:eq(0)").addClass("on");
		$(".right dl dd:eq(1)").addClass("on");
		$(".right dl dd:eq(2)").addClass("on");
		$(".right dl dd:eq(7)").addClass("nbd");


		});
</script>

<div class="ci_weixin" id="ci_weixin" style="z-index: 1; right: 30px;">
<img src="<?=bloginfo('url')?>/images/erweima.gif" width="96" height="110">
<a href="javascript:void(0)" title="关闭" onclick="this.parentNode.style.display='none';return false;" target="_self">关闭</a>
</div>

<?php include('inc/footer.php') ?>
</body>
</html>
