<?php
include_once("../ci_xmlrpc.php");
include_once("/opt/ci123/www/html/news/cron/inc/config.php");
include_once("/opt/ci123/www/html/news/cron/inc/mysqlClass.php");

$con = mysql_connect(DB_HOST,DB_USERNAME,DB_PASSWORD);
$ms = mysql_select_db("news", $con);

//目前是针对给育儿百科内页的热门资讯用的
function getNewsHot($method,$param){
	$limit = isset($param[0])?intval($param[0]):0;
	$photosData = unserialize(file_get_contents(dirname(dirname(__FILE__)).'/wp-content/themes/news_v3/glbRightPhotosDatanew.cache'));
	return $photosData;
}

function getNewsArticle($method,$param){
	global $ms;
	$start_date = isset($param[0])?trim($param[0]):date('Y-m-d');
	$end_date = date("Y-m-d",strtotime($start_date)+86400);
	//	$limit = isset($param[0])?trim($param[0]):date('Y-m-d');
	$sql = "select * from `news_posts` where `post_status`='publish' and {$start_date}<`post_date` and `post_date`<'{$end_date}' order by ID desc limit 10";
	return $sql;
	$res = $ms->getRows($sql);
	return $res;
	if($res){
		foreach($res as $v){
			//获取版块
			$sql = "select `term_taxonomy_id` from `news_term_relationships` where object_id = {$value['ID']} and `term_taxonomy_id` in (1,24,45,109,110) limit 1";
			$cateid = $ms->getRow($sql);
			$sql = "select `name` from `news_terms` where `term_id`={$cateid['term_taxonomy_id']} limit 1";
			$cate = $ms->getRow($sql);
			//获取作者
			$sql = "select `meta_value` from `news_usermeta` where `user_id` = {$value['post_author']} and `meta_key` in ('last_name','first_name') order by `umeta_id` desc limit 2";
			$tmp = $ms->getRows($sql);
			$item[$v['ID']]['author'] = $tmp[0]['meta_value'].$tmp[1]['meta_value'];
			$item[$v['ID']]['cate']= $cate['name'];
			$item[$v['ID']]['title'] = $value['post_title'];
			$tmp = explode("相关文章",$value['post_content']);
			$item[$v['ID']]['post_content'] = $tmp[0];
			$item[$v['ID']]['date'] = $value['post_date'];
			return $item;
		}
	}
}



$xmlrpc_server = new  xmlrpc_server();
$xmlrpc_server->register_method("news.getNewsHot", "getNewsHot");
$xmlrpc_server->register_method("news.getNewsArticle", "getNewsArticle");
$xmlrpc_server->call_method();
?>
