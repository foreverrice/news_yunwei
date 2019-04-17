<?php
require_once('./admin.php');
require_once('./admin-header.php');
$sliderDataEdit = dirname(dirname(__FILE__)).'/wp-content/themes/news.ci123.com/topSliderDataEdit.cache';
$sliderDataCache = dirname(dirname(__FILE__)).'/wp-content/themes/news.ci123.com/topSliderData.cache';
$sliderData = unserialize(file_get_contents($sliderDataEdit));

$num = $sliderData['num'] ? $sliderData['num'] : 2;

if (isset($_POST['save']))
{
	// 组
	for ($i = 0; $i < intval($_POST['num']); $i++)
	{
		for ($j = 0; $j < $num; $j++)
		{
			$sliderDataNew['slider'.$j][$i]['src'] = $_POST['cover'.$i.'_'.$j];
			$sliderDataNew['slider'.$j][$i]['name'] = $_POST['texts'.$i.'_'.$j];
			$sliderDataNew['slider'.$j][$i]['link'] = $_POST['links'.$i.'_'.$j];
		}
	}

	$sliderDataNew['num'] = intval($_POST['num']);

	$output = serialize($sliderDataNew);
	$fp = fopen($sliderDataEdit, "w");
	fputs($fp, $output);
	fclose($fp);

	echo "<script>window.location='http://news.ci123.com/wp-admin/ci123-topSlider.php';</script>";
}

if (isset($_POST['flush']))
{
	$sliderData = file_get_contents($sliderDataEdit);
	$fp = fopen($sliderDataCache, "w");
	fputs($fp, $sliderData);
	fclose($fp);

	echo "<script>window.location='http://news.ci123.com/wp-admin/ci123-topSlider.php';</script>";
}

?>
<script type='text/javascript' src='<?=bloginfo('url')?>/js/jquery-1.7.2.min.js'></script>
<style type="text/css">
	.imgUpload { width: 225px; height: 135px; border: 3px dashed #DCDCDC; font-size: 20px; font-weight: bold; font-family: "黑体"; color: #DCDCDC; text-align: center; line-height: 135px; }
	.clearfix:after { visibility: hidden; display: block; font-size: 0; content: "."; clear: both; height: 0; line-height: 0; overflow: hidden; }
	.clearfix { *zoom: 1; }
	.fl { float: left; display: inline; }
	.ipt { border-color: #CCC; padding: 3px 8px; font-size: 14px; line-height: 100%; width: 215px; outline: 0; -webkit-border-radius: 3px; border-radius: 3px; border-width: 1px; border-style: solid; color: #333; margin: 10px 0 0 0; }
	.ipt2 { border-color: #CCC; padding: 3px 8px; font-size: 1.7em; line-height: 100%; width: 150px; outline: 0; -webkit-border-radius: 3px; border-radius: 3px; border-width: 1px; border-style: solid; color: #333; }
	.box { margin: 0 20px 20px 0; }
	.box h2 { font-family: "黑体"; font-size: 22px; }
	.box h2, .box span { font-family: "黑体"; font-size: 16px; }
	.box .tit { margin: 0 0 0 20px; }
</style>
<script type='text/javascript'>
<?php for ($j = 0; $j < 4; $j++) { ?>
	<?php for ($i = 0; $i < $num; $i++) { ?>
	var tpl_box<?=$i?>_<?=$j?> = '<div class="progress<?=$i?>_<?=$j?>"><img id="coverImg<?=$i?>_<?=$j?>" src="" width="225" height="135" /><input type="hidden" id="coverImgSrc<?=$i?>_<?=$j?>" name="cover<?=$i?>_<?=$j?>" value="" /></div>';
	<?php } ?>
	$(document).ready(function() {
		if ( !window.File || !window.FileReader || !window.FileList || !window.Blob )
		{
			alert('你的浏览器弱爆了！请使用Chrome！');
		}
		<?php for ($i = 0; $i < $num; $i++) { ?>
		document.getElementById("imgUpload<?=$i?>_<?=$j?>").addEventListener('dragover', function(e) {
			e.stopPropagation();
			e.preventDefault();
		}, false);
		document.getElementById("imgUpload<?=$i?>_<?=$j?>").addEventListener('drop', function(e) {
			e.stopPropagation();
			e.preventDefault();
			upload_files<?=$i?>_<?=$j?>( e.dataTransfer.files );
		}, false);
		<?php } ?>
	});

	<?php for ($i = 0; $i < $num; $i++) { ?>
	function upload_files<?=$i?>_<?=$j?>( files )
	{
		$('#message_upload').hide();
		for (var i = 0, f; f = files[i]; i++)
		if ( f.type=='image/jpeg' || f.type=='image/png' || f.type=='image/gif' )
		{
			upload_file<?=$i?>_<?=$j?>( f );
		}
		else
		{
			alert( f.name + ' 不是图片！' );
		}
	}
	<?php } ?>

	<?php for ($i = 0; $i < $num; $i++) { ?>
	function upload_file<?=$i?>_<?=$j?>( f )
	{
		var name = f.name;
		if ( name.length > 15 )
		{
			name = name.substr(0, 15)+'...';
		}
		var $box = $(tpl_box<?=$i?>_<?=$j?>);
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
		XHR.upload.addEventListener("progress<?=$i?>_<?=$j?>", function(e) {
			if ( !e.lengthComputable)
			{
				return;
			}
			var percentComplete = parseInt(e.loaded / e.total * 100);
		}, false);
		XHR.onreadystatechange = function() {
			if ( this.readyState == this.DONE )
			{
				$box.find('#coverImg<?=$i?>_<?=$j?>').attr({"src":"../" + escape(this.responseText)});
				$box.find('#coverImgSrc<?=$i?>_<?=$j?>').val("<?=bloginfo('url')?>/" + escape(this.responseText));
			}
		}
		XHR.send( f );
		$('#imgUpload<?=$i?>_<?=$j?>').html($box);
	}
	<?php } ?>
<?php } ?>
</script>

<form name="myform" method="POST" action="">
	<div class="box">
		<h1>首页顶部轮播图配置</h1>
	</div>
	<div class="box">
		<h2>基本参数</h2>
		<p><span>图片组数：</span><input name="num" value="<?=$num?>" class="ipt2" /><span style="margin-left: 10px;">组</span></p>
		<p><span>图片尺寸：225*135 请自行PS处理压缩至合适尺寸与大小</span></p>
	</div>
	
	<?php for ($i = 0; $i < $num; $i++) { ?>
	<h2>第<?=($i+1)?>组图</h2>
	<div class="clearfix" style="width: 1050px;">
		<?php for ($j = 0; $j < 4; $j++) { ?>
		<div class="box fl">
			<div id="imgUpload<?=$i?>_<?=$j?>" class="imgUpload ">
				<?php if ($sliderData['slider'.$j][$i]['src']) { ?>
					<img src="<?=$sliderData['slider'.$j][$i]['src']?>" width="225" height="135" />
					<input type="hidden" name="cover<?=$i?>_<?=$j?>" value="<?=$sliderData['slider'.$j][$i]['src']?>" />
				<?php } else { ?>
					将图片拖动至此
				<?php } ?>
			</div>
			<div class="">
				<p><input name="texts<?=$i?>_<?=$j?>" value="<?=$sliderData['slider'.$j][$i]['name']?>" class="ipt" placeholder="在此填写标题..." /></p>
				<p><input name="links<?=$i?>_<?=$j?>" value="<?=$sliderData['slider'.$j][$i]['link']?>" class="ipt" placeholder="在此填写地址..." /></p>
			</div>
		</div>
		<?php } ?>
	</div>
	<?php } ?>
	<input type="submit" name="save" id="publish" class="button-primary" value="保存" tabindex="5" accesskey="p" />
	<input type="submit" name="flush" id="publish" class="button-primary" value="刷新缓存" tabindex="5" accesskey="p" />
</form>

<?php
include('./admin-footer.php');