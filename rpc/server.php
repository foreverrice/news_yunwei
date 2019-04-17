<?php
include_once("../ci_xmlrpc.php");

//目前是针对给育儿百科内页的热门资讯用的
function getNewsHot($method,$param){
	$limit = isset($param[0])?intval($param[0]):0;
	
	$photosData = unserialize(file_get_contents(dirname(dirname(__FILE__)).'/wp-content/themes/news_v3/glbRightPhotosDatanew.cache'));
	return $photosData;
}

function getArticleByDate($method,$param) {
	$date = trim($param[0]);
	$last_time = trim($param[1]);
	if (!$date || strtotime($date) < '2000-01-01') {
		return false;
	}
	$date = date('Y-m-d', strtotime($date));
	$dt1 = $date.' 00:00:00';
	$dt2 = $date.' 23:59:59';
	if ($last_time) {
		$dt1 = max($dt1, $last_time);
	}
	include_once('../wp-config.php');
	include_once('../wp-settings.php');
	include_once('../cron/inc/config.php');
	include_once('../cron/inc/mysqlClass.php');
	$categorys = array(1,24,45,109,110); //分类编号
	$ms = new Mysqls(true);
	$data = array();
	$sql = "select * from `news_posts` where `post_status`='publish' and `post_date`>='{$dt1}' and `post_date`<='{$dt2}' order by `post_date` asc limit 100";
	$rows = $ms->getRows($sql);
	foreach($rows as $value) {
		// 标题
		$title = $value['post_title'];
		// 图片
		$tmp = get_post_thumbnail_id($value['ID']);
		if ($tmp) {
			$pic = wp_get_attachment_url($tmp);
		} else {
			$pic = '';
		}
		// 内容
		$tmp = explode('相关文章', $value['post_content']);
		$content = $tmp[0];
		$content = str_replace(array('<p>','</p>'),array("\n\r","\n\r"), $content);
		$content = preg_replace("/[\n\r]/i",'</p><p>', $content);
		$content = '<p>'.strip_tags($content, '<p><img>').'</p>';
		$content = str_replace(array('<p></p>',']]>'), array('','</p><p>'), $content);
		// 标签
		$sql = "select `term_taxonomy_id` from `news_term_relationships` where object_id={$value['ID']}";
		$tmp = $ms->getRows($sql);
		$tags = array();
		foreach($tmp as $k => $v){
			$sql = "select `term_id`,`name`,`slug`,`term_id` from `news_terms` where term_id={$v['term_taxonomy_id']} limit 1";
			$tmp_tags = $ms->getRow($sql);
			if(in_array($tmp_tags['term_id'],$categorys)){
				continue;
			}
			$tags[] = $tmp_tags['name'];
		}
		$tags = implode(',', $tags);
		// 分类
		$sql = "select `term_taxonomy_id` from `news_term_relationships` where object_id = {$value['ID']} and `term_taxonomy_id` in (1,24,45,109,110) limit 1";
		$tmp = $ms->getRow($sql);
		if($tmp['term_taxonomy_id'] == 109){
			continue;
		}
		$sql = "select `name` from `news_terms` where `term_id`={$tmp['term_taxonomy_id']} limit 1";
		$tmp = $ms->getRow($sql);
		$cate = $tmp['name'];
		// 作者
		$sql = "select `meta_value` from `news_usermeta` where `user_id` = {$value['post_author']} and `meta_key` in ('last_name','first_name') order by `umeta_id` desc limit 2";
		$tmp = $ms->getRows($sql);
		$author = $tmp[0]['meta_value'].$tmp[1]['meta_value'];
		// 发布时间
		$date = $value['post_date'];
		// 链接地址
		$link = 'http://news.ci123.com/article/'.$value['ID'].'.html';
		// 返回
		$data[] = array(
			'title' => $title,
			'pic' => $pic,
			'content' => $content,
			'tags' => $tags,
			'cate' => $cate,
			'author' => $author,
			'date' => $date,
			'link' => $link,
		);
	}
	return $data;
}

$xmlrpc_server = new  xmlrpc_server();
$xmlrpc_server->register_method("news.getNewsHot", "getNewsHot");
$xmlrpc_server->register_method("news.getArticleByDate", "getArticleByDate");
$xmlrpc_server->call_method();
?>
