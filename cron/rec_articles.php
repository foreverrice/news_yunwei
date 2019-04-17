<?php
include_once("../cron/inc/config.php");
$con = mysql_connect(DB_HOST,DB_USERNAME,DB_PASSWORD);
$DB = mysql_select_db("news", $con);
$now = date("Y-m-d H:i:s");
$sql = "select `ID` ,  `post_title` ,  `post_content`  from `news_posts` where post_type='post' and post_status='publish' and post_date<'{$now}' order by ID desc limit 5";
$relate = getRows($sql);
foreach($relate as $k=>$v){
    preg_match ("<img.*src=[\"](.*?)[\"].*?>",$v['post_content'],$match);
    $relate[$k]['img'] = str_replace(".jpeg","-150x150.jpeg",$match[1]);
}
$data = json_encode($relate);
$cache_file = "/opt/ci123/www/html/news/cron/relate_articles.cache";
$f = fopen($cache_file,"w+");
fwrite($f,$data);
fclose($f);

function getRows($sql){     //取出多条数据
	global $con;
	$query = mysql_query($sql,$con);
	$data = array();
	while($row = mysql_fetch_array($query,MYSQL_ASSOC)){
		$data[] = $row;
	}
	return $data;
}
