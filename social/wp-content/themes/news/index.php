<?php include_once('heade_new.php'); ?>

<div class="index">
	
	<div class="clearfix mgt10">
		<div class="knowledge">
			<?php include_once('homeToutiao_new.php'); ?>
		<div class="view" id="yuershidian">
		<?php include_once('yuershidian.php'); ?>
			
		</div><!--/view-->
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
<?php include('inc/footer.php') ?>
</body>
</html>
