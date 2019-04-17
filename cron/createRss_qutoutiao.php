<?php
include_once('./inc/config.php');
include_once('./inc/mysqlClass.php');

if(isset($_SERVER['SERVER_PROTOCOL']) && strpos($_SERVER['SERVER_PROTOCOL'],'HTTP') !== false){
        //如果是浏览器访问 输出禁止访问
    echo '该页面不允许单独访问'; 
    exit;
}
$ms = new Mysqls();
$fp = fopen("../rss_qutoutiao.xml","w");
$categorys = array(1,24,45,109,110);

echo "脚本执行开始时间：".date('Y-m-d H:i:s')."\r\n";
//写入xml头部
$headerStr = "<?xml version=\"1.0\" encoding=\"utf-8\"?>\r\n";
$headerStr.= "<rss version=\"2.0\">\r\n";
$headerStr.= "<channel>\r\n";
$headerStr.= "	<title>育儿网</title>\r\n";
$headerStr.= "  <description>轻松孕育，上育儿网。与您每天共享育儿及育儿有关的生活方式。</description\r\n>";
$headerStr.= "  <copyright>版权申明,禁止转载说明</copyright>\r\n";
$headerStr.= "	<link>http://news.ci123.com</link>\r\n";
$headerStr.= "  <image>\r\n";
$headerStr.= "      <url>http://www.ci123.com/index/styles/images/logo20151.jpg</url>\r\n";
$headerStr.= "      <title>育儿网</title>\r\n";
$headerStr.= "      <link>http://www.ci123.com</link>\r\n";
$headerStr.= "  </image>\r\n";
$flag = fwrite($fp, $headerStr);

// 开始查询当天的文章
$date = date("Y-m-d H:i:s");
$dated = date("Y-m-d", strtotime("-1 day"));

// 从news_posts表中，找数据
$sql = "select * from `news_posts` where `post_status`='publish' and `post_date`>'{$dated}' order by ID desc limit 500";
$res = $ms->getRows($sql);

// $res 存放$sql里面的数据内容
if($res){
	foreach($res as $value){
		$item = array();
		// 获取版块
		$sql = "select `term_taxonomy_id` from `news_term_relationships` where object_id = {$value['ID']} and `term_taxonomy_id` in (1,24,45,110) limit 1";
		
                $sql_first_name = "select * from `news_usermeta` where user_id = {$value['post_author']} and meta_key = 'first_name' limit 1";
                $tmp = $ms->getRow($sql_first_name);
                $first_name = $tmp['meta_value'];

                $sql_last_name = "select * from `news_usermeta` where user_id = {$value['post_author']} and meta_key = 'last_name' limit 1";
                $tmp = $ms->getRow($sql);
                $last_name = $tmp['meta_value'];
                $item['author'] = $last_name.$first_name;


                // 种类id
                $cateid = $ms->getRow($sql);
                
                // 文章标题
		$item['title'] = $value['post_title'];
		// 处理内容
		$tmp = explode("相关文章", $value['post_content']);
                
                // tmp 
		$item['post_content'] = $tmp[0];
                // str_replace有3个参数, 作用是把$item['post_content']的array('<p>','</p>'), 替换为array("\n\r","\n\r")
		$item['post_content'] = str_replace(array('<p>','</p>'), array("\n\r","\n\r"), $item['post_content']);
		
                // preg_replace有3个参数, 执行正则表达式的搜索与替换
                $item['post_content'] = preg_replace("/[\n\r]/i", '</p><p>', $item['post_content']);
		
                $content = "<p>".$item['post_content']."</p>";
		// 剥去字符串中年的html标签
                $item['post_content'] = strip_tags($content, "<p><img>");

		$item['post_content'] = str_replace('<p></p>', '', $item['post_content']);
		$item['post_content'] = str_replace(']]>', '</p><p>', $item['post_content']);

                // 发布时间
		$item['date'] = date("D, d M Y H:i:s", strtotime($value['post_date']))."+0800";
		$item['source'] = "育儿网";
		$item['link'] = "http://news.ci123.com/article/".$value['ID'].".html";
                
               

		$itemStr  = "	<item>\r\n";
		$itemStr .= "		<title><![CDATA[".$item['title']."]]></title>\r\n";
		$itemStr .= "		<link>".$item['link']."</link>\r\n";
		$itemStr .= "		<description>\r\n";
		$itemStr .= "		<![CDATA[".trim($item['post_content'])."]]>\r\n";
		$itemStr .= "		</description>\r\n";
		$itemStr .= "       <source>".$item['source']."</source>\r\n";
		$itemStr .= "		<pubDate>".$item['date']."</pubDate>\r\n";
		$itemStr .= "	</item>\r\n";
		fwrite($fp,$itemStr);
	}
}
fwrite($fp,"</channel>\r\n</rss>\r\n");
fclose($fp); 
echo "脚本执行结束时间：".date('Y-m-d H:i:s')."\r\n";
?>
