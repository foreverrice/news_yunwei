<?php
	$sliderData = unserialize(file_get_contents(dirname(__FILE__).'/homeGroupsData.cache'));
?>
<div class="board">
	<div class="tags"><span>热点关注：</span>
	<?php
	/*
	<a href="http://news.ci123.com/article/tag/<?=$sliderData['tags'][0]?>"><?=$sliderData['tags'][0]?></a><a href="http://news.ci123.com/article/tag/<?=$sliderData['tags'][1]?>"><?=$sliderData['tags'][1]?></a><a href="http://news.ci123.com/article/tag/<?=$sliderData['tags'][2]?>"><?=$sliderData['tags'][2]?></a><a href="http://news.ci123.com/article/tag/<?=$sliderData['tags'][3]?>"><?=$sliderData['tags'][3]?></a><a href="http://news.ci123.com/article/tag/<?=$sliderData['tags'][4]?>"><?=$sliderData['tags'][4]?></a>
	*/
	?>
	</div>
	<ul class="clearfix">
		<li>
			<div class="group">
				<span class="h2"><a href="http://news.ci123.com/article/tag/<?=$sliderData['groupTags'][0]?>"><?=$sliderData['groupTags'][0]?></a></span>
				<h3><a href="<?=$sliderData['links'][0]?>"><?=$sliderData['titles'][0]?></a></h3>
				<div class="tw clearfix">
					<img class="fl" src="<?=$sliderData['imgs'][0]?>" />
					<div class="fl"><?=$sliderData['texts'][0]?></div>
				</div> 
				<div class="other"><a href="<?=$sliderData['groupOther1Links'][0]?>"><?=$sliderData['groupOther1'][0]?></a></div>
				<div class="other"><a href="<?=$sliderData['groupOther2Links'][0]?>"><?=$sliderData['groupOther2'][0]?></a></div>
			</div>
		</li>
		<li class="s"></li>
		<li>
			<div class="group">
				<span class="h2"><a href="http://news.ci123.com/article/tag/<?=$sliderData['groupTags'][1]?>"><?=$sliderData['groupTags'][1]?></a></span>
				<h3><a href="<?=$sliderData['links'][1]?>"><?=$sliderData['titles'][1]?></a></h3>
				<div class="tw clearfix">
					<img class="fl" src="<?=$sliderData['imgs'][1]?>" />
					<div class="fl"><?=$sliderData['texts'][1]?></div>
				</div>
				<div class="other"><a href="<?=$sliderData['groupOther1Links'][1]?>"><?=$sliderData['groupOther1'][1]?></a></div>
				<div class="other"><a href="<?=$sliderData['groupOther2Links'][1]?>"><?=$sliderData['groupOther2'][1]?></a></div>
			</div>
		</li>
		<li>
			<div class="group">
				<span class="h2"><a href="http://news.ci123.com/article/tag/<?=$sliderData['groupTags'][2]?>"><?=$sliderData['groupTags'][2]?></a></span>
				<h3><a href="<?=$sliderData['links'][2]?>"><?=$sliderData['titles'][2]?></a></h3>
				<div class="tw clearfix">
					<img class="fl" src="<?=$sliderData['imgs'][2]?>" />
					<div class="fl"><?=$sliderData['texts'][2]?></div>
				</div>
				<div class="other"><a href="<?=$sliderData['groupOther1Links'][2]?>"><?=$sliderData['groupOther1'][2]?></a></div>
				<div class="other"><a href="<?=$sliderData['groupOther2Links'][2]?>"><?=$sliderData['groupOther2'][2]?></a></div>
			</div>
		</li>
		<li class="s"></li>
		<li>
			<div class="group">
				<span class="h2"><a href="http://news.ci123.com/article/tag/<?=$sliderData['groupTags'][3]?>"><?=$sliderData['groupTags'][3]?></a></span>
				<h3><a href="<?=$sliderData['links'][3]?>"><?=$sliderData['titles'][3]?></a></h3>
				<div class="tw clearfix">
					<img class="fl" src="<?=$sliderData['imgs'][3]?>" />
					<div class="fl"><?=$sliderData['texts'][3]?></div>
				</div>
				<div class="other"><a href="<?=$sliderData['groupOther1Links'][3]?>"><?=$sliderData['groupOther1'][3]?></a></div>
				<div class="other"><a href="<?=$sliderData['groupOther2Links'][3]?>"><?=$sliderData['groupOther2'][3]?></a></div>
			</div>
		</li>
		<li>
			<div class="group">
				<span class="h2"><a href="http://news.ci123.com/article/tag/<?=$sliderData['groupTags'][4]?>"><?=$sliderData['groupTags'][4]?></a></span>
				<h3><a href="<?=$sliderData['links'][4]?>"><?=$sliderData['titles'][4]?></a></h3>
				<div class="tw clearfix">
					<img class="fl" src="<?=$sliderData['imgs'][4]?>" />
					<div class="fl"><?=$sliderData['texts'][4]?></div>
				</div>
				<div class="other"><a href="<?=$sliderData['groupOther1Links'][4]?>"><?=$sliderData['groupOther1'][4]?></a></div>
				<div class="other"><a href="<?=$sliderData['groupOther2Links'][4]?>"><?=$sliderData['groupOther2'][4]?></a></div>
			</div>
		</li>
		<li class="s"></li>
		<li>
			<div class="group">
				<span class="h2"><a href="http://news.ci123.com/article/tag/<?=$sliderData['groupTags'][5]?>"><?=$sliderData['groupTags'][5]?></a></span>
				<h3><a href="<?=$sliderData['links'][5]?>"><?=$sliderData['titles'][5]?></a></h3>
				<div class="tw clearfix">
					<img class="fl" src="<?=$sliderData['imgs'][5]?>" />
					<div class="fl"><?=$sliderData['texts'][5]?></div>
				</div>
				<div class="other"><a href="<?=$sliderData['groupOther1Links'][5]?>"><?=$sliderData['groupOther1'][5]?></a></div>
				<div class="other"><a href="<?=$sliderData['groupOther2Links'][5]?>"><?=$sliderData['groupOther2'][5]?></a></div>
			</div>
		</li>
		<li>
			<div class="group">
				<span class="h2"><a href="http://news.ci123.com/article/tag/<?=$sliderData['groupTags'][6]?>"><?=$sliderData['groupTags'][6]?></a></span>
				<h3><a href="<?=$sliderData['links'][6]?>"><?=$sliderData['titles'][6]?></a></h3>
				<div class="tw clearfix">
					<img class="fl" src="<?=$sliderData['imgs'][6]?>" />
					<div class="fl"><?=$sliderData['texts'][6]?></div>
				</div>
				<div class="other"><a href="<?=$sliderData['groupOther1Links'][6]?>"><?=$sliderData['groupOther1'][6]?></a></div>
				<div class="other"><a href="<?=$sliderData['groupOther2Links'][6]?>"><?=$sliderData['groupOther2'][6]?></a></div>
			</div>
		</li>
		<li class="s"></li>
		<li>
			<div class="group">
				<span class="h2"><a href="http://news.ci123.com/article/tag/<?=$sliderData['groupTags'][7]?>"><?=$sliderData['groupTags'][7]?></a></span>
				<h3><a href="<?=$sliderData['links'][7]?>"><?=$sliderData['titles'][7]?></a></h3>
				<div class="tw clearfix">
					<img class="fl" src="<?=$sliderData['imgs'][7]?>" />
					<div class="fl"><?=$sliderData['texts'][7]?></div>
				</div>
				<div class="other"><a href="<?=$sliderData['groupOther1Links'][7]?>"><?=$sliderData['groupOther1'][7]?></a></div>
				<div class="other"><a href="<?=$sliderData['groupOther2Links'][7]?>"><?=$sliderData['groupOther2'][7]?></a></div>
			</div>
		</li>
	</ul>
</div>