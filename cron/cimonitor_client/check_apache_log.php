<?php
///////////////////////////////////////////
echo "\nstart @ ".date('Y-m-d H:i:s')."\n";
///////////////////////////////////////////

if (isset($_SERVER['SERVER_PROTOCOL']) && strpos($_SERVER['SERVER_PROTOCOL'],'HTTP') !== false) {
    //如果是浏览器访问 输出禁止访问
    echo '该页面不允许单独访问';
    exit;
}

include_once("class_xmlrpc.php");
$total = 0; //慢访问总数
$current_hour = date('H')-1;
if($current_hour<10){
	$current_hour = '0'.$current_hour;
}
$current_md = date('Y-m-d',strtotime("-1 hours"));

$command = "grep '2016:".$current_hour.":' /opt/ci123/apache/logs/news.ci123.com-access.".$current_md." |awk -F ' - - ' '{print $2}'|awk '{print $8/1000/1000,$1,$4,$3}'|sort -nr|less";
$a = exec($command,$out);

$apache_current_state = array();
foreach ($out as $log) {
	$log_info = getLogInfo($log);
	$request = $log_info['request'];
	$time = $log_info['time'];
	if ($time>1) {
		$apache_current_state[$request]['total_time'] += $time;
		$apache_current_state[$request]['sum']++;
		$total++;
	}
}

if ($apache_current_state) {
	$data = getApacheMonitorLogContent($apache_current_state);	
	$to = array('zhubing@corp-ci.com');
	$title  = '【监控】-育儿资讯-Apache访问慢请求日志';
	$content = $data;
	$c = new  xmlrpc_client("http://search.ci123.com/rpc/server_email2.php","emailrpc");
	$res = $c->call("search_email2",array('subject'=>$title,'content'=>$content),$to,'bug','');
}

function getLogInfo($log){
	$result = array();
	$tmp = explode(' ', $log);
	$result['time'] = $tmp[0];
	$result['date'] = $tmp[1];
	$request_str = $tmp[2];
	$tmp2 = explode('?', $request_str); //去除get参数
	$request_str = $tmp2[0];
	$result['request'] = preg_replace('/\/0\.[0-9]+/', '/', $request_str);

	return $result;
}

function getApacheMonitorLogContent($apache_current_state){
	$content = '<style>@chartset "UTF-8" th,td{margin:0;padding:0} table{border-collapse:collapse;border-spacing:0} table tr th{background:#dfdfdf;} .table-list{width:850px;background:#fff;margin:10px 0;} .table-list table tr td,table tr th{width:16.6%;height:20px;padding:8px;border:1px solid #e7eaec;} .table-list table .dateb td{background:#e7eaec;} .table-list{border-collapse: collapse;font-size: 16px;width: 100%;text-align: center;} th{background: #dfdfdf;border: 1px solid #e7eaec;}table{border-collapse:collapse;}th {background:#B9B9B9;border: 1px solid #e7eaec;}td{border:1px solid #dfdfdf;}</style>
		<div class="wrapper"><div class="table-list"><div class="page">
		<table cellpadding="20px">
		<tr>
		<th>请求</th>
		<th>请求次数</th>
		<th>总请求时间</th>
		<th>平均请求时间</th>
		</tr>
		';
	foreach($apache_current_state as $request=>$info){
		$apache_current_state[$request]['average_time'] = number_format(floatval($info['total_time']/$info['sum']), 2);
	}
	$apache_current_state = arraySort($apache_current_state, 'average_time', 'desc');
	$pos = 0;
	foreach( $apache_current_state as $request=>$info ){
		$class = $pos%2==0 ? "a":"b";
		$content .= '
			<tr class="date'.$class.'">
			<td>'.$request.'</td>
			<td>'.$info['sum'].'</td>
			<td>'.$info['total_time'].'</td>
			<td>'.$info['average_time'].'</td>
			</tr>';
		$pos++;
	}
	$content .= '</table></div></div></div>';
	return $content;
}

function arraySort($array, $key, $order='asc'){
	$arr_nums=$arr=array();
	foreach($array as $k=>$v){
		$arr_nums[$k]=$v[$key];
	}
	if($order=='asc'){
		asort($arr_nums);
	}else{
		arsort($arr_nums);
	}
	foreach($arr_nums as $k=>$v){
		$arr[$k]=$array[$k];
	}
	return $arr;
}
////////////////////////////////////////////
echo "\nfinish @ ".date('Y-m-d H:i:s')."\n";
////////////////////////////////////////////
?>

