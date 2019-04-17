<?php
include_once(dirname(dirname(__FILE__)).'/inc/config.php');
include_once(dirname(dirname(__FILE__)).'/inc/mysqlClass.php');

if(isset($_SERVER['SERVER_PROTOCOL']) && strpos($_SERVER['SERVER_PROTOCOL'],'HTTP') !== false){
    die('该页面不允许单独访问'); 
}
echo "脚本执行开始时间：".date('Y-m-d H:i:s')."\r\n";

$ms = new Mysqls();

$item = array();

//开始查询当天的文章
$date = date("Y-m-d");
$sql = "select id from `news_posts` where `post_date`>'{$date}' and  post_status =  'publish' limit 10";
$res = $ms->getRows($sql);
foreach($res as $value){
	$link = "http://news.ci123.com/wap/". $value['id'] .".html";
	$item[] = $link;
	logs($link);
}

$api = 'http://data.zz.baidu.com/urls?appid=1552596662208100&token=ItIMqICBjaUTyoLs&type=realtime';
$ch = curl_init();
$options =  array(
    CURLOPT_URL => $api,
    CURLOPT_POST => true,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POSTFIELDS => implode("\n", $item),
    CURLOPT_HTTPHEADER => array('Content-Type: text/plain'),
);
curl_setopt_array($ch, $options);
$result = curl_exec($ch);
echo $result;


echo "脚本执行结束时间：".date('Y-m-d H:i:s')."\r\n";

function logs($data){
	$s = "[".date('Y-m-d H:i:s')."] ".$data.PHP_EOL;
	file_put_contents(dirname(__FILE__).'/log/lg.txt', $s, FILE_APPEND);
}

?>
