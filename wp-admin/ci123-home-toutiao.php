<?php
require_once('./admin.php');
require_once('./admin-header.php');
$sliderDataEdit = dirname(dirname(__FILE__)).'/wp-content/themes/news_v3/homeToutiaoDataEditnew.cache';
$sliderDataCache = dirname(dirname(__FILE__)).'/wp-content/themes/news_v3/homeToutiaoDatanew.cache';
$sliderData = unserialize(file_get_contents($sliderDataEdit));

$num = 1;
//$tags = $sliderData['tags'] ? $sliderData['tags'] : array('', '', '', '', '', '');
//$tagsLinks = $sliderData['tagsLinks'] ? $sliderData['tagsLinks'] : array('', '', '', '', '', '');
//$groupTags = $sliderData['groupTags'] ? $sliderData['groupTags'] : array('', '', '', '', '', '', '', '');
//$groupTagsLinks = $sliderData['groupTagsLinks'] ? $sliderData['groupTagsLinks'] : array('', '', '', '', '', '', '', '');
$imgs = $sliderData['imgs'] ? $sliderData['imgs'] : array('', '', '', '', '', '', '', '');
$links = $sliderData['links'] ? $sliderData['links'] : array('', '', '', '', '', '', '', '');
$titles = $sliderData['titles'] ? $sliderData['titles'] : array('', '', '', '', '', '', '', '');
$texts = $sliderData['texts'] ? $sliderData['texts'] : array('', '', '', '', '', '', '', '');
$toutiaoList = $sliderData['toutiaoList'] ? $sliderData['toutiaoList'] : array('', '', '', '', '', '', '', '');
$toutiaoListLinks = $sliderData['toutiaoListLinks'] ? $sliderData['toutiaoListLinks'] : array('', '', '', '', '', '', '', '');
$toutiaoListTexts = $sliderData['toutiaoListTexts'] ? $sliderData['toutiaoListTexts'] : array('', '', '', '', '', '', '', '');
//$groupOther2Links = $sliderData['groupOther2Links'] ? $sliderData['groupOther2Links'] : array('', '', '', '', '', '', '', '');

if (isset($_POST['save']))
{
	for ($j = 0; $j < 21; $j++)
	{
		$toutiaoList[$j] = $_POST['toutiaoList'.$j];
		$toutiaoListLinks[$j] = $_POST['toutiaoListLinks'.$j];
		$toutiaoListTexts[$j] = $_POST['toutiaoListTexts'.$j];
	}
	
	for ($i = 0; $i < 1; $i++)
	{
		$imgs[$i] = $_POST['cover'.$i];
		$links[$i] = $_POST['links'.$i];
		$titles[$i] = $_POST['titles'.$i];
		$texts[$i] = $_POST['texts'.$i];
		//$groupTags[$i] = $_POST['groupTags'.$i];
		//$groupTagsLinks[$i] = $_POST['groupTagsLinks'.$i];
		//$groupOther1[$i] = $_POST['groupOther1'.$i];
		//$groupOther2[$i] = $_POST['groupOther2'.$i];
		//$groupOther1Links[$i] = $_POST['groupOther1Links'.$i];
		//$groupOther2Links[$i] = $_POST['groupOther2Links'.$i];
	}

	$sliderData = array(
		//'time'		=> intval($_POST['time']),
		//'num'		=> intval($_POST['num']),
		'imgs'		=> $imgs,
		'links'		=> $links,
		'titles'	=> $titles,
		'texts'		=> $texts,
		'toutiaoList'	=> $toutiaoList,
		'toutiaoListLinks' => $toutiaoListLinks,
		'toutiaoListTexts'	=> $toutiaoListTexts
		//'tags'		=> $tags,
		//'tagsLinks'		=> $tagsLinks,
		//'groupTags'		=> $groupTags,
		//'groupTagsLinks'		=> $groupTagsLinks,
		//'groupOther1'		=> $groupOther1,
		//'groupOther2'		=> $groupOther2,
		//'groupOther1Links'		=> $groupOther1Links,
		//'groupOther2Links'		=> $groupOther2Links
	);
	$output = serialize($sliderData);
	$fp = fopen($sliderDataEdit, "w");
	fputs($fp, $output);
	fclose($fp);
	echo "<script>window.location='http://news.ci123.com/wp-admin/ci123-home-toutiao.php';</script>";
}

if (isset($_POST['flush']))
{
	$sliderData = file_get_contents($sliderDataEdit);
	$fp = fopen($sliderDataCache, "w");
	fputs($fp, $sliderData);
	fclose($fp);

	echo "<script>window.location='http://news.ci123.com/wp-admin/ci123-home-toutiao.php';</script>";
}
?>
<script type='text/javascript' src='<?=bloginfo('url')?>/js/jquery-1.7.2.min.js'></script>
<style type="text/css">
	.imgUpload { width: 275px; height: 288px; border: 3px dashed #DCDCDC; font-size: 20px; font-weight: bold; font-family: "黑体"; color: #DCDCDC; text-align: center; line-height: 80px; }
	.clearfix:after { visibility: hidden; display: block; font-size: 0; content: "."; clear: both; height: 0; line-height: 0; overflow: hidden; }
	.clearfix { *zoom: 1; }
	.fl { float: left; display: inline; }
	.ipt { border-color: #CCC; padding: 3px 8px; font-size: 14px; line-height: 100%; width: 348px; outline: 0; -webkit-border-radius: 3px; border-radius: 3px; border-width: 1px; border-style: solid; color: #333; margin: 10px 0 0 0; }
	.ipt2 { border-color: #CCC; padding: 3px 8px; font-size: 1.7em; line-height: 100%; width: 348px; outline: 0; -webkit-border-radius: 3px; border-radius: 3px; border-width: 1px; border-style: solid; color: #333; }
	.box { margin: 0 20px 20px 0; }
	.box h2 { font-family: "黑体"; font-size: 22px; }
	.box h2, .box span { font-family: "黑体"; font-size: 16px; }
	.box .tit { margin: 0 0 0 20px; }
	textarea { width: 360px; }
</style>
<script type='text/javascript'>
<?php for ($i = 0; $i < $num; $i++) { ?>
	var tpl_box<?=$i?> = '<div class="progress<?=$i?>"><img id="coverImg<?=$i?>" src="" width="275" height="288" /><input type="hidden" id="coverImgSrc<?=$i?>" name="cover<?=$i?>" value="" /></div>';
<?php } ?>
	$(document).ready(function() {
		if ( !window.File || !window.FileReader || !window.FileList || !window.Blob )
		{
			alert('你的浏览器弱爆了！请使用Chrome！');
		}
		<?php for ($i = 0; $i < $num; $i++) { ?>
		document.getElementById("imgUpload<?=$i?>").addEventListener('dragover', function(e) {
			e.stopPropagation();
			e.preventDefault();
		}, false);
		document.getElementById("imgUpload<?=$i?>").addEventListener('drop', function(e) {
			e.stopPropagation();
			e.preventDefault();
			upload_files<?=$i?>( e.dataTransfer.files );
		}, false);
		<?php } ?>
	});

	<?php for ($i = 0; $i < $num; $i++) { ?>
	function upload_files<?=$i?>( files )
	{
		$('#message_upload').hide();
		for (var i = 0, f; f = files[i]; i++)
		if ( f.type=='image/jpeg' || f.type=='image/png' || f.type=='image/gif' )
		{
			upload_file<?=$i?>( f );
		}
		else
		{
			alert( f.name + ' 不是图片！' );
		}
	}
	<?php } ?>

	<?php for ($i = 0; $i < $num; $i++) { ?>
	function upload_file<?=$i?>( f )
	{
		var name = f.name;
		if ( name.length > 15 )
		{
			name = name.substr(0, 15)+'...';
		}
		var $box = $(tpl_box<?=$i?>);
		var XHR = new XMLHttpRequest();
		XHR.open('PUT', 'ci123-upload.php', true);
		for (var key in f)
		{
			var val = f[key];
			// ff
			if ( typeof(val) == 'string' || typeof(val) == 'number' )
			{
				XHR.setRequestHeader('file_'+key, val);
			}
		}
		XHR.upload.addEventListener("progress<?=$i?>", function(e) {
			if ( !e.lengthComputable)
			{
				return;
			}
			var percentComplete = parseInt(e.loaded / e.total * 100);
		}, false);
		XHR.onreadystatechange = function() {
			if ( this.readyState == this.DONE )
			{
				$box.find('#coverImg<?=$i?>').attr({"src":"../" + escape(this.responseText)});
				$box.find('#coverImgSrc<?=$i?>').val("<?=bloginfo('url')?>/" + escape(this.responseText));
			}
		}
		XHR.send( f );
		$('#imgUpload<?=$i?>').html($box);
	}
	<?php } ?>
</script>

<form name="myform" method="POST" action="">
	<div class="box">
		<h1>首页标签组推荐</h1>
	</div>
	<div class="box">
		<h2>基本参数</h2>
		<!--p><span>图片数量：</span><input name="num" value="<?=$num?>" class="ipt2" /><span style="margin-left: 10px;">张</span></p-->
		<p><span>图片尺寸：275*288</span></p>
	</div>
    
	<div class="clearfix" style="width: 900px;">
    <h2>头条有图：</h2>
	<?php for ($i = 0; $i < $num; $i++) { ?>
	<div class="box fl">
        <div id="imgUpload<?=$i?>" class="imgUpload ">
			<?php if ($imgs[$i]) { ?>
				<img src="<?=$imgs[$i]?>" width="275" height="288" />
				<input type="hidden" name="cover<?=$i?>" value="<?=$imgs[$i]?>" />
			<?php } else { ?>
				将图片拖动至此
			<?php } ?>
		</div>
		<div class="">
			<p><input name="titles<?=$i?>" value="<?=$titles[$i]?>" class="ipt" placeholder="在此填写标题..." /></p>
			<p><input name="links<?=$i?>" value="<?=$links[$i]?>" class="ipt" placeholder="在此填写地址..." /></p>
            <p><textarea name="texts<?=$i?>"><?=$texts[$i]?></textarea></p>
           </div>
	</div>
	<?php } ?>
	</div>
    
    <div style="width: 900px;" >
    <h2>头条：</h2>
	<div class="clearfix">
	<?php for ($i = 0; $i < 21; $i++) { ?>
		<div id="box<?=$i?>" class="bx">
		<h2>
		<?php
			if (($i%7) == 0)
			{
				echo "第".intval($i/7+1)."组大标题";
			}
			else
			{	
				echo "第".intval($i/7+1)."组 "."第".($i%7)."个小标题";
			}

		?>
		</h2>
    	<div class="box" >
        	<p><input name="toutiaoList<?=$i?>" value="<?=$toutiaoList[$i]?>" class="ipt" placeholder="在此填写标签..." /></p>
        <p><input name="toutiaoListLinks<?=$i?>" value="<?=$toutiaoListLinks[$i]?>" class="ipt" placeholder="在此填写标签地址..." /></p>
		</div>
        </div>
	<?php } ?>
	</div>
	<input type="submit" name="save" id="publish" class="button-primary" value="保存" tabindex="5" accesskey="p" />
	<input type="submit" name="flush" id="flush" class="button-primary" value="刷新缓存" tabindex="5" accesskey="p" />
</form>
<script type="text/javascript">
	$(function() {
	  $(".bx").each(function(idx){
			if ((idx%7) == 0)
			{
				$(this).css({"width":"900px", "float":"left", "display": "inline", "margin-top": "50px", "text-align": "center", "border-top": "2px solid #DCDCDC"});
			}
			else
			{
				$(this).css({"width":"450px", "float":"left", "display": "inline"});
			}
	  });


		});
</script>

<?php
include('./admin-footer.php');
