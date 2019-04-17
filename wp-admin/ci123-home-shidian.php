<?php
require_once('xmlrpc.php');
require_once('./admin.php');
require_once('./admin-header.php');
$shidianDataEdit = dirname(dirname(__FILE__)).'/wp-content/themes/news_v3/shidianDataEditnew.cache';
$shidianDataCache = dirname(dirname(__FILE__)).'/wp-content/themes/news_v3/shidianDatanew.cache';
$shidianData = unserialize(file_get_contents($shidianDataEdit));

$num = 1;
$numbers = $shidianData['numbers'] ? $shidianData['numbers'] : array('', '', '', '');
$imgs = $shidianData['imgs'] ? $shidianData['imgs'] : array('', '', '', '');
$link = $shidianData['link'] ? $shidianData['link'] : array('', '', '', '');
$titles = $shidianData['titles'] ? $shidianData['titles'] : array('', '', '', '');
$titleslink = $shidianData['titleslink'] ? $shidianData['titleslink'] : array('', '', '', '');
$texts = $shidianData['texts'] ? $shidianData['texts'] : array('', '', '', '');

$shidianqi = $shidianData['shidianqi'] ? $shidianData['shidianqi'] : array('', '', '', '');
$shidiantext = $shidianData['shidiantext'] ? $shidianData['shidiantext'] : array('', '', '', '');
$shidianA = $shidianData['shidianA'] ? $shidianData['shidianA'] : array('', '', '', '');
$shidianAn = $shidianData['shidianAn'] ? $shidianData['shidianAn'] : array('', '', '', '');
$shidianB = $shidianData['shidianB'] ? $shidianData['shidianB'] : array('', '', '', '');
$shidianBn = $shidianData['shidianBn'] ? $shidianData['shidianBn'] : array('', '', '', '');

 $shidian = new xmlrpc_client('http://www.ci123.com/special/rpc/vote.php', 'view');
  $result = $shidian->call('getVote',$shidianqi[0]);
$question = $result['question'];
  $answer1=$result['answer1'];
  $answer2=$result['answer2'];
  $num1=$result['num1'];
  $num2=$result['num2'];
	//$shidiantext[$i]=$question;
if (isset($_POST['save']))
{
	for ($i = 0; $i < $num; $i++)
	{
		$imgs[$i] = $_POST['cover'.$i];
		$numbers[$i] = $_POST['numbers'.$i];
		$link[$i] = $_POST['link'.$i];
		$titles[$i] = $_POST['titles'.$i];
		$texts[$i] = $_POST['texts'.$i];
		$titleslink[$i] = $_POST['titleslink'.$i];

		$shidianqi[$i] = $_POST['shidianqi'.$i];
		$shidiantext[$i] =$_POST['shidiantext'.$i];
		$shidianA[$i] = $answer1;
		$shidianAn[$i] = $num1;
		$shidianB[$i] =  $answer2;
		$shidianBn[$i] = $num2;
	
	}

	$shidianData = array(
		'numbers'   => $numbers,
		'imgs'		=> $imgs,
		'link'      => $link,
		'titles'	=> $titles,
		'texts'     => $texts,
		'titleslink'=> $titleslink,
		'shidianqi'  =>$shidianqi,
		'shidiantext'=>$shidiantext,
		'shidianA'   =>$shidianA,
		'shidianAn'  =>$shidianAn,
		'shidianB'   =>$shidianB,
		'shidianBn'  =>$shidianBn
		
	);
	$output = serialize($shidianData);
	$fp = fopen($shidianDataEdit, "w");
	fputs($fp, $output);
	fclose($fp);
	echo "<script>window.location='http://news.ci123.com/wp-admin/ci123-home-shidian.php';</script>";
}

if (isset($_POST['flush']))
{
	$shidianData = file_get_contents($shidianDataEdit);
	$fp = fopen($shidianDataCache, "w");
	fputs($fp, $shidianData);
	fclose($fp);

	echo "<script>window.location='http://news.ci123.com/wp-admin/ci123-home-shidian.php';</script>";
}
?>
<script type='text/javascript' src='<?=bloginfo('url')?>/js/jquery-1.7.2.min.js'></script>
<style type="text/css">
	.imgUpload { width: 248px; height: 128px; border: 3px dashed #DCDCDC; font-size: 20px; font-weight: bold; font-family: "黑体"; color: #DCDCDC; text-align: center; line-height: 80px; }
	.clearfix:after { visibility: hidden; display: block; font-size: 0; content: "."; clear: both; height: 0; line-height: 0; overflow: hidden; }
	.clearfix { *zoom: 1; }
	.fl { float: left; display: inline; }
	.ipt { border-color: #CCC; padding: 3px 8px; font-size: 14px; line-height: 100%; width: 235px; outline: 0; -webkit-border-radius: 3px; border-radius: 3px; border-width: 1px; border-style: solid; color: #333; margin: 10px 0 0 0; }
	.ipt2 { border-color: #CCC; padding: 3px 8px; font-size: 1.7em; line-height: 100%; width: 150px; outline: 0; -webkit-border-radius: 3px; border-radius: 3px; border-width: 1px; border-style: solid; color: #333; }
	.box { margin: 0 20px 20px 0; }
	.box h2 { font-family: "黑体"; font-size: 22px; }
	.box h2, .box span { font-family: "黑体"; font-size: 16px; }
	.box .tit { margin: 0 0 0 20px; }
	.box textarea{width:252px;height:80px;}
</style>
<script type='text/javascript'>
<?php for ($i = 0; $i < 8; $i++) { ?>
	var tpl_box<?=$i?> = '<div class="progress<?=$i?>"><img id="coverImg<?=$i?>" src="" width="248" height="128" /><input type="hidden" id="coverImgSrc<?=$i?>" name="cover<?=$i?>" value="" /></div>';
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
		<h1>育儿视点</h1>
	</div>
	<div class="box">
		<h2>基本参数</h2>
	<p><span>图片尺寸：248*128</span></p>
	<p><span>投票问题字数：不超过20</span></p>
	</div>
	<div class="clearfix" style="width: 900px;">
	<?php for ($i = 0; $i < $num; $i++) { ?>
	<div class="box fl">
		
		<div id="imgUpload<?=$i?>" class="imgUpload ">
			<?php if ($imgs[$i]) { ?>
				<img src="<?=$imgs[$i]?>" width="248" height="128" />
				<input type="hidden" name="cover<?=$i?>" value="<?=$imgs[$i]?>" />
			<?php } else { ?>
				将图片拖动至此
			<?php } ?>
		</div>
		<div class="">
			<p><input name="link<?=$i?>" value="<?=$link[$i]?>" class="ipt" placeholder="在此填写封面链接..." /></p>
			<p><input name="numbers<?=$i?>" value="<?=$numbers[$i]?>" class="ipt" placeholder="在此填写期数..." /></p>
			<p><input name="titles<?=$i?>" value="<?=$titles[$i]?>" class="ipt" placeholder="在此填写标题..." /></p>
			<p><input name="titleslink<?=$i?>" value="<?=$titleslink[$i]?>" class="ipt" placeholder="在此填写标题链接..." /></p>
			<p><textarea name="texts<?=$i?>"><?=$texts[$i]?></textarea></p>
			<h2>育儿视点投票</h2>
			<p><input name="shidianqi<?=$i?>" value="<?=$shidianqi[$i]?>" class="ipt" placeholder="在此填写投票期数..." /></p>
			<p>观点原始数据：<?=$question?></p>
			<p><textarea name="shidiantext<?=$i?>"><?=$shidiantext[$i]?></textarea></p>
			<h3>投票的选项</h3>
			<p><input name="shidianA<?=$i?>" value="<?=$shidianA[$i]?>" class="ipt" placeholder="在此填写A选项..." /></p>
			<p><input style="display:none" name="shidianAn<?=$i?>" value="<?=$shidianAn[$i]?>" class="ipt" placeholder="在此填写A票数..." /></p>
			<p><input name="shidianB<?=$i?>" value="<?=$shidianB[$i]?>" class="ipt" placeholder="在此填写B选项..." /></p>   
			<p><input style="display:none" name="shidianBn<?=$i?>" value="<?=$shidianBn[$i]?>" class="ipt" placeholder="在此填写B票数..." /></p>
			</div>
	</div>
	<?php } ?>
	
	</div>
	

	
	<input type="submit" name="save" id="publish" class="button-primary" value="保存" tabindex="5" accesskey="p" />
	<input type="submit" name="flush" id="flush" class="button-primary" value="刷新缓存" tabindex="5" accesskey="p" />
</form>

<?php
include('./admin-footer.php');
