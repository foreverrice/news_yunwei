<?php
include_once('./inc/config.php');
include_once('./inc/mysqlClass.php');

if(isset($_SERVER['SERVER_PROTOCOL']) && strpos($_SERVER['SERVER_PROTOCOL'],'HTTP') !== false){
        //如果是浏览器访问 输出禁止访问
    echo '该页面不允许单独访问'; 
    exit;
}
$ms = new Mysqls();
$fp = fopen("../rss_alipay.xml","w");

echo "脚本执行开始时间：".date('Y-m-d H:i:s')."\r\n";
//写入xml头部
$headerStr = "<?xml version=\"1.0\" encoding=\"utf-8\"?>\r\n";
$headerStr.= "<rss version=\"2.0\">\r\n";
$headerStr.= "<channel>\r\n";
$headerStr.= "	<title>育儿资讯-育儿网</title>\r\n";
$headerStr.= "	<description>育儿网新闻频道为全球华人提供最新最快最详实的育儿资讯、热点新闻、育儿动态、图片新闻。</description>\r\n";
$headerStr.= "	<link>http://news.ci123.com</link>\r\n";
$headerStr.= "	<lastBuildDate>".date('D, d M Y H:i:s')."</lastBuildDate>\r\n";
$headerStr.= "	<generator>yanwei@corp-ci.com</generator>\r\n";
$flag = fwrite($fp,$headerStr);

//开始查询当天的文章
$date = date("Y-m-d H:i:s");
//$sql = "select * from `news_posts` where `post_date`>'{$date}' limit 10";
$sql = "select * from `news_posts` where `post_status`='publish' order by ID desc limit 10";
$res = $ms->getRows($sql);
if($res){
	foreach($res as $value){
		$item = array();
		$sql = "select * from `news_usermeta` where user_id = {$value['post_author']} and meta_key = 'first_name' limit 1";
		$tmp = $ms->getRow($sql);
		$first_name = $tmp['meta_value'];
		$sql = "select * from `news_usermeta` where user_id = {$value['post_author']} and meta_key = 'last_name' limit 1";
		$tmp = $ms->getRow($sql);
		$last_name = $tmp['meta_value'];
		$item['author'] = $last_name.$first_name;
		
		$item['title'] = $value['post_title'];
		$item['desc'] = str_replace('<strong>', '<br /><strong>', $value['post_content']);
		$item['link'] = "http://news.ci123.com/article/".$value['ID'].".html";
		$item['source'] = "育儿网";
		$item['date'] = date("D, d M Y H:i:s",strtotime($value['post_date']))."+0800";
		$itemStr  = "	<item>\r\n";
		$itemStr .= "		<title>".$item['title']."</title>\r\n";
		$itemStr .= "		<link>".$item['link']."</link>\r\n";
		$itemStr .= "		<description><![CDATA[".$item['desc']."]]></description>\r\n";
		$itemStr .= "		<author>".$item['author']."</author>\r\n";
		$itemStr .= "		<source>".$item['source']."</source>\r\n";
		$itemStr .= "		<pubDate>".$item['date']."</pubDate>\r\n";
		$itemStr .= "		<guid isPermaLink=\"false\">".$item['link']."</guid>\r\n";
		$itemStr .= "	</item>\r\n";
		fwrite($fp,$itemStr);
	}
}
fwrite($fp,"</channel>\r\n</rss>\r\n");
fclose($fp); 
echo "脚本执行结束时间：".date('Y-m-d H:i:s')."\r\n";

?>
