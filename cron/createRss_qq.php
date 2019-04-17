<?php
include_once('./inc/config.php');
include_once('./inc/mysqlClass.php');

if(isset($_SERVER['SERVER_PROTOCOL']) && strpos($_SERVER['SERVER_PROTOCOL'],'HTTP') !== false){
        //如果是浏览器访问 输出禁止访问
    echo '该页面不允许单独访问'; 
    exit;
}
$ms = new Mysqls();
$fp = fopen("../rss_qq.xml","w");
$categorys = array(1,24,45,109,110);

echo "脚本执行开始时间：".date('Y-m-d H:i:s')."\r\n";
//写入xml头部
$headerStr = "<?xml version=\"1.0\" encoding=\"utf-8\"?>\r\n";
$headerStr.= "<rss version=\"2.0\">\r\n";
$headerStr.= "<channel>\r\n";
$headerStr.= "	<title>育儿资讯-育儿网</title>\r\n";
$headerStr.= "	<link>http://news.ci123.com</link>\r\n";
$headerStr.= "	<language>zh-cn</language>\r\n";
$flag = fwrite($fp,$headerStr);

//开始查询当天的文章
$date = date("Y-m-d H:i:s");
$dated = date("Y-m-d",strtotime("-30 day"));
//$sql = "select * from `news_posts` where `post_date`>'{$date}' limit 10";
//$sql = "select count(*) as num from `news_posts` where `post_status`='publish' and `post_date`>'{$dated}' limit 1";
//$res = $ms->getRow($sql);
$sql = "select * from `news_posts` where `post_status`='publish' and `post_date`>'{$dated}' order by ID desc limit 500";
$res = $ms->getRows($sql);
if($res){
	foreach($res as $value){
		$item = array();

		//获取版块
		$sql = "select `term_taxonomy_id` from `news_term_relationships` where object_id = {$value['ID']} and `term_taxonomy_id` in (1,24,45,109,110) limit 1";
		$cateid = $ms->getRow($sql);
		if($cateid['term_taxonomy_id'] == 109){
			continue;
		}
		$sql = "select `name` from `news_terms` where `term_id`={$cateid['term_taxonomy_id']} limit 1";
		$cate = $ms->getRow($sql);

		//获取作者
		$sql = "select `meta_value` from `news_usermeta` where `user_id` = {$value['post_author']} and `meta_key` in ('last_name','first_name') order by `umeta_id` desc limit 2";
		$tmp = $ms->getRows($sql);

		$item['author'] = $tmp[0]['meta_value'].$tmp[1]['meta_value'];
		$item['cate']=$cate['name'];
		$item['title'] = $value['post_title'];
		$tmp = explode("相关文章",$value['post_content']);
		$item['post_content'] = $tmp[0];
		$item['post_content'] = str_replace(array('<p>','</p>'),array("\n\r","\n\r"),$item['post_content']);
		$item['post_content'] = preg_replace("/[\n\r]/i",'</p><p>',$item['post_content']);
		$content = "<p>".$item['post_content']."</p>";
//		var_dump($item['post_content']);die();
		$item['post_content'] = strip_tags($content,"<p><img>");
		$item['post_content'] = str_replace('<p></p>','',$item['post_content']);
		$item['post_content'] = str_replace(']]>','</p><p>',$item['post_content']);
		$item['date'] = $value['post_date'];
		$item['link'] = "http://news.ci123.com/article/".$value['ID'].".html";
		$itemStr  = "	<item>\r\n";
		$itemStr .= "		<title>".$item['title']."</title>\r\n";
		$itemStr .= "		<link>".$item['link']."</link>\r\n";
		$itemStr .= "		<description>\r\n";
		$itemStr .= "		<![CDATA[".trim($item['post_content'])."]]>\r\n";
		$itemStr .= "		</description>\r\n";
		$itemStr .= "		<category>".$item['cate']."</category>\r\n";
		$itemStr .= "		<author>".$item['author']."</author>\r\n";
		$itemStr .= "		<pubDate>".$item['date']."</pubDate>\r\n";
		$itemStr .= "	</item>\r\n";
		fwrite($fp,$itemStr);
	}
}
fwrite($fp,"</channel>\r\n</rss>\r\n");
fclose($fp); 
echo "脚本执行结束时间：".date('Y-m-d H:i:s')."\r\n";

?>
