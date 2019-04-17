<?php
	require_once('./admin.php');
	require_once('./admin-header.php');

	global $wpdb;
	if ($_GET['begin'] && $_GET['end'])
	{
		$s = explode(" ", $_GET['begin']);
		$e = explode(" ", $_GET['end']);
		$start = strtotime($s[2].'-'.$s['1'].'-'.$s['0']);
                $end = strtotime($e[2].'-'.$e['1'].'-'.$e['0']) + 86399;
	}
	else
	{
		date_default_timezone_set('Asia/Shanghai');
		$start = strtotime('today');
                $end = strtotime('today') + 86399;
	}
	$cond = "`date` >= '".$start."' AND `date` <= '".$end."'";
	$dis = $wpdb->get_results("SELECT DISTINCT `from`,`title`,`link` FROM `news_click_record` WHERE ".$cond." ORDER BY `from` DESC");
	foreach ($dis as $key => $val)
	{
		$records[$key]['from'] = $dis[$key]->from;
		$records[$key]['title'] = $dis[$key]->title;
		$records[$key]['link'] = $dis[$key]->link;
		$records[$key]['count'] = count($wpdb->get_results("SELECT `id` FROM `news_click_record` WHERE ".$cond." AND `from` = '".$dis[$key]->from."' AND `title` = '".$dis[$key]->title."' ORDER BY `from` DESC"));
	}
	
	function getFromName($from)
	{
		if ($from == 'homeToutiaoPic')
		{
			return "图片头条";
		}
		elseif ($from == 'homeToutiaoText')
		{
			return "文字头条";
		}
		elseif ($from == 'tushuo')
		{
			return "图说";
		}
		elseif ($from == "groupTitle")
		{
			return "标签组标签";
		}
		elseif ($from == "groupToutiaoPic")
		{
			return "标签组头条图片";
		}
		elseif ($from == "groupToutiaoText")
		{
			return "标签组头条文章";
		}
		elseif ($from == "video")
		{
			return "视频";
		}
		elseif ($from == "hottext")
		{
			return "右侧热门文章";
		}
		elseif ($from == "yuershidian")
		{
			return "育儿视点";
		}
	}
?>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.1/jquery.min.js"></script>
<script type="text/javascript" src="http://news.ci123.com/lib/date_input/jquery.date_input.js"></script>
<script type="text/javascript">$($.date_input.initialize);</script>
<link rel="stylesheet" href="http://news.ci123.com/lib/date_input/date_input.css" type="text/css">
<style type="text/css">
h1 { font-weight: bold; font-family: "微软雅黑", font-size: 22px; }
table { margin-top: 10px; border: 1px solid gray; }
td { border-bottom: 1px solid gray; border-right: 1px solid gray; padding: 8px 10px; }
table form { margin: 10px 0px; }
table thead { background: #EEE; }
table a { text-decoration: none; }
.time { margin: 10px 0px; }
</style>
<h1>点击统计</h1>
<form action="" method="GET">
选择时间： 开始 <input type="text" name="begin" class="date_input"> 结束 <input type="text" name="end" class="date_input"> <input type="submit" value="查询" />
</form>
<div class="time">当前数据：<?php echo date("Y年m月d日 H:i:s", $start);?> - <?php echo date("Y年m月d日 H:i:s", $end);?></div>
<table width="510" border="0" cellspacing="0" cellpadding="0" class="tablist">
	<thead>
		<tr>
			<td align="left" width="100">来源</td>
                        <td align="left" width="300">去向</td>
                        <td align="left">点击数</td>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($records as $key => $val) { ?>
		<?php if (($records[$key]['from'] != $records[$key-1]['from']) && $key > 0) { echo "<tr><td style=\"background: #EEE;\" colspan=\"3\">&nbsp;</td></tr>";} ?>
		<tr>
			<td>
			<?php
				echo getFromName($records[$key]['from']);
			?>
			</td>
			<td><a href="<?php echo $records[$key]['link'];?>" target="_blank"><?php echo $records[$key]['title'];?></a></td>
			<td><?php echo $records[$key]['count'];?></td>
		</tr>
		<?php } ?>
	</tbody>
</table>
