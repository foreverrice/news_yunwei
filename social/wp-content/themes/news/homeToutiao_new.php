<?php
	$sliderData = unserialize(file_get_contents(dirname(__FILE__).'/homeToutiaoDatanew.cache'));
?>
	<div class="fleft">
				<div id="bigimg"><a href="<?=$sliderData['links'][0]?>" title="<?=$sliderData['titles'][0]?>"><img src="<?=$sliderData['imgs'][0]?>" width="275" height="288" /></a></div>
				<div class="teach">
					<h3><a href="<?=$sliderData['links'][0]?>" title="<?=$sliderData['titles'][0]?>"><?=$sliderData['titles'][0]?></a></h3>
					<p><?=$sliderData['texts'][0]?></p>
				</div><!--/teach-->
	</div><!--/fleft-->
	<div id="toutiaotitle">
	
      <?php for ($j = 0; $j < 3; $j++) { ?>    
		  <div class="fright">
				<dl id="fright<?=$j?>">
					<dt><h3><a  href="<?=$sliderData['toutiaoListLinks'][7*$j]?>" title="<?=$sliderData['toutiaoList'][7*$j]?>"><?=$sliderData['toutiaoList'][7*$j]?></a></h3></dt>
					<?php for ($i =7*$j+1; $i <7*$j+7; $i++) { ?>
					<dd>▪ <a href="<?=$sliderData['toutiaoListLinks'][$i]?>" title="<?=$sliderData['toutiaoList'][$i]?>"><?=$sliderData['toutiaoList'][$i]?></a></dd>
					<?php } ?>
				</dl>
		</div>
			<?php } ?>
	</div>
		</div><!--/knowledge-->

	<script type="text/javascript">
	$(function() {
		$("#fright0").addClass("nbd");
	});
	</script>