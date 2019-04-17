<?php
/**
 * 百度原创提交 
 */

$ip =  getIp();
if ($ip != '218.94.95.50' && $ip != '218.94.95.62') {
	echo '你想干嘛?';die();
}

$url = $_GET['url']; 
if (!$url) {
	echo '请传入链接哦！'; die();
}

if (!strstr($url, 'news.ci123.com')) {
	echo '链接错啦！'; die();
}

$urls = array($url);
$api = 'http://data.zz.baidu.com/urls?site=http://news.ci123.com/&token=ud5qO5EIb1mW3yFs&type=original';
$ch = curl_init();
$options =  array(
		CURLOPT_URL => $api,
		CURLOPT_POST => true,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_POSTFIELDS => implode("\n", $urls),
		CURLOPT_HTTPHEADER => array('Content-Type: text/plain'),
		);
curl_setopt_array($ch, $options);
$result = curl_exec($ch);
$res = json_decode($result , 1);

echo "成功了".$res['success']. "条";die();

function getIp(){
	$ip = false;
	if(!empty($_SERVER["HTTP_CLIENT_IP"])){
		$ip = $_SERVER["HTTP_CLIENT_IP"];
	}
	if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
		$ips = explode (", ", $_SERVER['HTTP_X_FORWARDED_FOR']);
		if ($ip) {
			array_unshift($ips, $ip);
			$ip = FALSE;
		}
		for ($i = 0; $i < count($ips); $i++) {
			if (!preg_match("/^(10|172\.16|192\.168)\./", $ips[$i])) { // 判断是否内网的IP
				$ip = $ips[$i];
				break;
			}
		}
	}
	return ($ip ? $ip : $_SERVER['REMOTE_ADDR']);
}

