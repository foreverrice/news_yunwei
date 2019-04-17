<?php
include_once("cron/inc/config.php");
//include_once(ABSPATH."wp-content/themes/news_v3/functions.php");
$photosData = unserialize(file_get_contents('/opt/ci123/www/html/news/wp-content/themes/news_v3/glbRightPhotosDatanew.cache'));
$bbsdata = json_decode(file_get_contents("/opt/ci123/www/html/news/wp-content/themes/news_v3/bbsRpc.cache"));
$baikedata = json_decode(file_get_contents("/opt/ci123/www/html/news/wp-content/themes/news_v3/keywords.cache"));
$hot_articles = json_decode(file_get_contents("/opt/ci123/www/html/news/cron/hot_articles.cache"),true);
$relate = json_decode(file_get_contents("/opt/ci123/www/html/news/cron/relate_articles.cache"),true);
$con = mysql_connect(DB_HOST,DB_USERNAME,DB_PASSWORD);
$DB = mysql_select_db("news", $con);

//$sql = "select `id` from `news_posts` where post_status='publish' limit 1";
$sql = "select count(*) from `news_posts` where post_status='publish' limit 1";
$data = getRow($sql);
var_dump($data);

