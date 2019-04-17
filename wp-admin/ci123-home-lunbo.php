<?php
require_once('./admin.php');
require_once('./admin-header.php');
$sliderDataEdit = dirname(dirname(__FILE__)).'/wp-content/themes/news_v3/homeLunBoDataEdit.cache';
$sliderDataCache = dirname(dirname(__FILE__)).'/wp-content/themes/news_v3/homeLunBoData.cache';
$sliderData = unserialize(file_get_contents($sliderDataEdit));

$time = $sliderData['time'] ? $sliderData['time'] : 5000;
$num = $sliderData['num'] ? $sliderData['num'] : 1;
$imgs = $sliderData['imgs'] ? $sliderData['imgs'] : array('', '', '', '', '');
$links = $sliderData['links'] ? $sliderData['links'] : array('', '', '', '', '');
$texts = $sliderData['texts'] ? $sliderData['texts'] : array('', '', '', '', '');

if (isset($_POST['save']))
{
	for ($i = 0; $i < intval($_POST['num']); $i++)
	{
		$imgs[$i] = $_POST['cover'.$i];
		$links[$i] = $_POST['links'.$i];
		$texts[$i] = $_POST['texts'.$i];
	}

	$sliderData = array(
		'time'		=> intval($_POST['time']),
		'num'		=> intval($_POST['num']),
		'imgs'		=> $imgs,
		'links'		=> $links,
		'texts'		=> $texts
	);
	$output = serialize($sliderData);
	$fp = fopen($sliderDataEdit, "w");
	$r=fputs($fp, $output);
	fclose($fp);
	echo "<script>window.location='http://news.ci123.com/wp-admin/ci123-home-lunbo.php';</script>";
}

if (isset($_POST['flush']))
{
	$sliderData = file_get_contents($sliderDataEdit);
	$fp = fopen($sliderDataCache, "w");
	fputs($fp, $sliderData);
	fclose($fp);

	echo "<script>window.location='http://news.ci123.com/wp-admin/ci123-home-lunbo.php';</script>";
}
?>
<script type='text/javascript' src='<?=bloginfo('url')?>/js/jquery-1.7.2.min.js'></script>
<style type="text/css">
	.imgUpload { width: 275px; height: 374px; border: 3px dashed #DCDCDC; font-size: 20px; font-weight: bold; font-family: "黑体"; color: #DCDCDC; text-align: center; line-height: 414px; }
	.clearfix:after { visibility: hidden; display: block; font-size: 0; content: "."; clear: both; height: 0; line-height: 0; overflow: hidden; }
	.clearfix { *zoom: 1; }
	.fl { float: left; display: inline; }
	.ipt { border-color: #CCC; padding: 3px 8px; font-size: 14px; line-height: 100%; width: 238px; outline: 0; -webkit-border-radius: 3px; border-radius: 3px; border-width: 1px; border-style: solid; color: #333; margin: 10px 0 0 0; }
	.ipt2 { border-color: #CCC; padding: 3px 8px; font-size: 1.7em; line-height: 100%; width: 150px; outline: 0; -webkit-border-radius: 3px; border-radius: 3px; border-width: 1px; border-style: solid; color: #333; }
	.box { margin: 0 20px 20px 0; }
	.box h2 { font-family: "黑体"; font-size: 22px; }
	.box h2, .box span { font-family: "黑体"; font-size: 16px; }
	.box .tit { margin: 0 0 0 20px; }
</style>
<script type='text/javascript'>
<?php for ($i = 0; $i < $num; $i++) { ?>
	var tpl_box<?=$i?> = '<div class="progress<?=$i?>"><img id="coverImg<?=$i?>" src="" width="275" height="374" /><input type="hidden" id="coverImgSrc<?=$i?>" name="cover<?=$i?>" value="" /></div>';
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
		<h1>首页轮播图配置</h1>
	</div>
	<div class="box">
		<h2>基本参数</h2>
		<p><span>图片数量：</span><input name="num" value="<?=$num?>" class="ipt2" /><span style="margin-left: 10px;">张</span></p>
		<p><span>滚动周期：</span><input name="time" value="<?=$time?>" class="ipt2" /><span style="margin-left: 10px;">秒</span></p>
		<p><span>图片尺寸：275*374 请自行PS处理压缩至合适尺寸与大小</span></p>
	</div>
	<div class="clearfix" style="width: 1000px;">
	<?php for ($i = 0; $i < $num; $i++) { ?>
	<div class="box fl">
		<h2>第<?=($i+1)?>张图</h2>
		<div id="imgUpload<?=$i?>" class="imgUpload ">
			<?php if ($imgs[$i]) { ?>
				<img src="<?=$imgs[$i]?>" width="275" height="374" />
				<input type="hidden" name="cover<?=$i?>" value="<?=$imgs[$i]?>" />
			<?php } else { ?>
				将图片拖动至此
			<?php } ?>
		</div>
		<div class="">
			<!--span class="tit">标题：</span--><p><input name="texts<?=$i?>" value="<?=$texts[$i]?>" class="ipt" placeholder="在此填写标题..." /></p>
			<!--span class="tit">地址：</span--><p><input name="links<?=$i?>" value="<?=$links[$i]?>" class="ipt" placeholder="在此填写地址..." /></p>
		</div>
	</div>
	<?php } ?>
	</div>
	<input type="submit" name="save" id="publish" class="button-primary" value="保存" tabindex="5" accesskey="p" />
	<input type="submit" name="flush" id="flush" class="button-primary" value="刷新缓存" tabindex="5" accesskey="p" />
</form>

<?php
include('./admin-footer.php');
