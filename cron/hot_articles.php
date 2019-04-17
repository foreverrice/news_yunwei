<?php
include_once("../cron/inc/config.php");
$con = mysql_connect(DB_HOST,DB_USERNAME,DB_PASSWORD);
$DB = mysql_select_db("news", $con);
$categorys = array(1,24,45,109,110);
foreach($categorys as $v){
	//获取热门分类文章
	$sql = "SELECT  `ID` ,  `post_title` ,  `comment_count` FROM  news_posts INNER JOIN news_term_relationships ON ( news_posts.`ID` = news_term_relationships.`object_id` )  INNER JOIN news_term_taxonomy ON ( news_term_relationships.`term_taxonomy_id` = news_term_taxonomy.`term_taxonomy_id` ) WHERE 1 =1 AND news_term_taxonomy.`taxonomy` =  'category' AND news_term_taxonomy.`term_id` ={$v} AND news_posts.`post_status` =  'publish' GROUP BY news_posts.`ID` ORDER BY `post_date` DESC  LIMIT 0,10";
	$relate[$v]= getRows($sql);
}
$data = json_encode($relate);
$cache_file = "/opt/ci123/www/html/news/cron/hot_articles.cache";
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
