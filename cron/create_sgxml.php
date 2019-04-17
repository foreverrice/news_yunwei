<?php
include_once('./inc/config.php');
include_once('./inc/mysqlClass.php');

if(isset($_SERVER['SERVER_PROTOCOL']) && strpos($_SERVER['SERVER_PROTOCOL'],'HTTP') !== false){
        //如果是浏览器访问 输出禁止访问
    echo '该页面不允许单独访问'; 
    exit;
}
$ms = new Mysqls();
$fp = fopen("../sgxml/sg1.xml","w");

echo "脚本执行开始时间：".date('Y-m-d H:i:s')."\r\n";
//写入xml头部
$headerStr = "<?xml version=\"1.0\" encoding=\"utf-8\"?>\r\n";
$headerStr.= "<urlset>";
$flag = fwrite($fp,$headerStr);

//开始查询当天的文章
//$date = date("Y-m-d H:i:s");
//$dated = date("Y-m-d",strtotime("-30 day"));
//$sql = "select * from `news_posts` where `post_date`>'{$date}' limit 10";
//$sql = "select count(*) as num from `news_posts` where `post_status`='publish' and `post_date`>'{$dated}' limit 1";
//$res = $ms->getRow($sql);

$limit = 100;
$j = 0;
for($i=0;$i<255;$i++){
	$start = $i*($limit);
	$sql = "select * from `news_posts` where `post_status`='publish' order by ID desc limit $start ,$limit";
	$data = $ms->getRows($sql);
	foreach($data as $k=>$v){
		$itemStr  = "	<url>\r\n";
		$itemStr .= "		<loc>http://news.ci123.com/article/".$v['id'].".html</loc>\r\n";
		$itemStr .= "		<lastmod>".$v['post_date']."</lastmod>\r\n";
		$itemStr .= "		<changefreq></changefreq>\r\n";
		$itemStr .= "		<priority></priority>\r\n";
		$itemStr .= "	</url>\r\n";
		fwrite($fp,$itemStr);
	}
	
}
fwrite($fp,"</urlset>\r\n");
fclose($fp); 
echo "脚本执行结束时间：".date('Y-m-d H:i:s')."\r\n";

?>
