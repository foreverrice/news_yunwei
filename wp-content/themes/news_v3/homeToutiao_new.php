<?php
	$sliderData = unserialize(file_get_contents(dirname(__FILE__).'/homeToutiaoDatanew.cache'));
?>
	<div class="fleft">
				<!--<a class="b-img" href="<?=$sliderData['links'][0]?>" title="<?=$sliderData['titles'][0]?>"><img src="<?=$sliderData['imgs'][0]?>" width="275" height="288" /></a>
				<div class="teach">
					<h3><a href="<?=$sliderData['links'][0]?>" title="<?=$sliderData['titles'][0]?>"><?=$sliderData['titles'][0]?></a></h3>
					<p><?=$sliderData['texts'][0]?></p>
				</div>--><!--/teach-->
		<?php include_once(dirname(__FILE__).'/homeLunBo.php');?>
	</div><!--/fleft-->
	
	<div class="fright">
				<dl class="nbd">
					<dt><h3><a  href="<?=$sliderData['toutiaoListLinks'][0]?>" title="<?=$sliderData['toutiaoList'][0]?>"><?=$sliderData['toutiaoList'][0]?></a></h3></dt>
					<?php for ($i = 1; $i < 7; $i++) { ?>
					<dd>▪ <a href="<?=$sliderData['toutiaoListLinks'][$i]?>" title="<?=$sliderData['toutiaoList'][$i]?>"><?=$sliderData['toutiaoList'][$i]?></a></dd>
					<?php } ?>
				</dl>
	</div><!--/fright-->
			<div class="fright">
				<dl>
					<dt><h3><a href="<?=$sliderData['toutiaoListLinks'][7]?>" title="<?=$sliderData['toutiaoList'][7]?>"><?=$sliderData['toutiaoList'][7]?></a></h3></dt>
					<?php for ($i = 8; $i < 14; $i++) { ?>
					<dd>▪ <a href="<?=$sliderData['toutiaoListLinks'][$i]?>" title="<?=$sliderData['toutiaoList'][$i]?>"><?=$sliderData['toutiaoList'][$i]?></a></dd>
					<?php } ?>
				</dl>
			</div><!--/fright-->
			<div class="fright">
				<dl>
					<dt><h3><a href="<?=$sliderData['toutiaoListLinks'][14]?>" title="<?=$sliderData['toutiaoList'][14]?>"><?=$sliderData['toutiaoList'][14]?></a></h3></dt>
					<?php for ($i = 15; $i < 21; $i++) { ?>
					<dd>▪ <a href="<?=$sliderData['toutiaoListLinks'][$i]?>" title="<?=$sliderData['toutiaoList'][$i]?>"><?=$sliderData['toutiaoList'][$i]?></a></dd>
					<?php } ?>
				</dl>
			</div><!--/fright--> 

<script type="text/javascript">
	$(function() {
		
	$("#fright0").addClass("nbd");


		});
</script>
