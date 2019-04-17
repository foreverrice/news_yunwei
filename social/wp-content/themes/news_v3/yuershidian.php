<?php
	$shidianData = unserialize(file_get_contents(dirname(__FILE__).'/shidianDatanew.cache'));
	$voteData = json_decode(file_get_contents("http://news.ci123.com/wp-content/themes/news_v3/shiDianRpc.php?id=".$shidianData['shidianqi'][0].""));
	
	//var_dump($voteData); 
	//$tuopiaoData = unserialize(file_get_contents(dirname(__FILE__).'/toupiaoData.cache'));
	//$result = file_get_contents('http://news.ci123.com/wp-content/themes/news/shiDianRpc.php');
	///var_dump($tuopiaoData['toupiaoData.cache']);
?>
<div class="time" id="yuerqishu" title="<?=$shidianData['numbers'][0]?>">第<?=$shidianData['numbers'][0]?>期</div>
<div class="why">
	<div><a href="<?=$shidianData['titleslink'][0]?>" target="_blank" title="<?=$shidianData['titles'][0]?>"><img src="<?=$shidianData['imgs'][0]?>" width="248" height="128" /></a></div>
	<h4><a href="<?=$shidianData['titleslink'][0]?>" title="<?=$shidianData['titles'][0]?>"  target="_blank" ><?=$shidianData['titles'][0]?></a></h4>
	<p><?=$shidianData['texts'][0]?><a href="<?=$shidianData['titleslink'][0]?>" title="<?=$shidianData['titles'][0]?>" target="_blank">详细&gt;&gt;</a></p>
	<h5><?=$shidianData['shidiantext'][0]?></h5>
	<div class="topic">
		<ul>
			<li class="b"><?=$voteData->num1?></li>
			<li id="toupiaoA"  style="cursor:pointer" qishu="<?=$shidianData['shidianqi'][0]?>"><?=$voteData->answer1?></li>
		</ul> 
		<ul>
			<li class="r"><?=$voteData->num2?></li>
			<li class="toupiaoB"  style="cursor:pointer"><?=$voteData->answer2?></li>
		</ul>
	</div><!--/topic-->
</div><!--/why-->
<script type="text/javascript">
	$(function() { 	
	
		var id=$("#toupiaoA").attr('qishu');
		
		$("#toupiaoA").click(function(){
		$.ajax({
				type: "POST",
				url: "http://news.ci123.com/wp-content/themes/news_v3/toupiaoajax.php?rnd=" + Math.random(), 
				data: {id:id},
				dataType: "JSON",
				success:function(oJ)
			{
				$(".topic .b").text(oJ.num1);
				
			}
		
		
		});
	});
		
		$(".toupiaoB").click(function(){
		
		$.ajax({
				type: "POST",
				url: "http://news.ci123.com/wp-content/themes/news_v3/toupiaoajaxb.php?rnd=" + Math.random(), 
				data: {id:id},
				dataType: "JSON",
				success:function(oJ)
			{
				
				$(".topic .r").text(oJ.num2);
				
			}
		
		
		});
	});
  });

</script>
