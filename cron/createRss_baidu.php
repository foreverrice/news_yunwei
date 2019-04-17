<?php
include_once('./inc/config.php');
include_once('./inc/mysqlClass.php');

if(isset($_SERVER['SERVER_PROTOCOL']) && strpos($_SERVER['SERVER_PROTOCOL'],'HTTP') !== false){
        //如果是浏览器访问 输出禁止访问
    echo '该页面不允许单独访问'; 
    exit;
}
$ms = new Mysqls();
$itemStr = "";

echo "脚本执行开始时间：".date('Y-m-d H:i:s')."\r\n";
//写入xml头部
$headerStr = "<?xml version=\"1.0\" encoding=\"utf-8\"?>\r\n";
$headerStr.= "<DOCUMENT content_method='full'>\r\n";

$date = date("Y-m-d H:i:s");
$dated = date("Y-m-d",strtotime("-7 day"));
$sql = "select * from `news_posts` where `post_status`='publish' and `post_date`>='{$dated}' order by ID desc limit 150";
$res = $ms->getRows($sql);
if($res){
	foreach($res as $value){
		//去除视频版块
		$sql = "select `term_taxonomy_id` from `news_term_relationships` where object_id = {$value['ID']} and `term_taxonomy_id`=109 limit 1";
		$cateid = $ms->getRow($sql);
		if($cateid){
			continue;
		}
		$item = array();
		$item['title'] = $value['post_title'];
		$tmp = explode("相关文章",$value['post_content']);
		$content = html2ubb($tmp[0]);
		$content = str_replace(array('[b]','[/b]','[img]','[/img]'),'[[]]',$content);
		$contents = explode('[[]]',$content);
		$item['date'] = substr($value['post_date'],0,16);
		$item['url'] = "http://news.ci123.com/article/".$value['ID'].".html";
		$itemStr .= "	<item>\r\n";
		$itemStr .= "		<key>亲子</key>\r\n";
		$itemStr .= "		<display>\r\n";
		$itemStr .= "			<title><![CDATA[".$item['title']."]]></title>\r\n";
		$itemStr .= "			<url>".$item['url']."</url>\r\n";
		$itemStr .= "			<provider>育儿网</provider>\r\n";
		$itemStr .= "			<time>".$item['date']."</time>\r\n";
		$itemStr .= "			<pagetype>image-text</pagetype>\r\n";
		$itemStr .= "			<contentlist>\r\n";
		foreach ($contents as $post_content) {
			if (!trim($post_content)) {continue;}
			if (strstr($post_content,'http://news.ci123.com')){
				list($width, $height, $type, $attr)  = getimagesize($post_content);
			$itemStr .= "               <content>\r\n";
			$itemStr .= "                   <type>image</type>\r\n";
			$itemStr .= "                   <data><![CDATA[".$post_content."]]></data>\r\n";
			$itemStr .= "                   <width>".$width."</width>\r\n";
			$itemStr .= "                   <height>".$height."</height>\r\n";
			$itemStr .= "                   <alt></alt>\r\n";
			$itemStr .= "                   <extradata></extradata>\r\n";
			$itemStr .= "               </content>\r\n";
		} else {
			$itemStr .= "               <content>\r\n";
			$itemStr .= "                   <type>text</type>\r\n";
			$itemStr .= "                   <data><![CDATA[".$post_content."]]></data>\r\n";
			$itemStr .= "                   <extradata></extradata>\r\n";
			$itemStr .= "               </content>\r\n";
		}
		}
		$itemStr .= "			</contentlist>\r\n";
		$itemStr .= "		</display>\r\n";
		$itemStr .= "	</item>\r\n";
	}
}
$fp = fopen("../rss_baidu.xml","w");
fwrite($fp,$headerStr.$itemStr."</DOCUMENT>\r\n");
fclose($fp); 
echo "脚本执行结束时间：".date('Y-m-d H:i:s')."\r\n";

function html2ubb($str) {
    $str = str_replace("\n",'',$str);
//  $str = preg_replace("/\<A[^>]+HREF=\"([^\"]+)\"[^>]*\>(.*?)<\/a\>/i","[url=$1]$2[/url]",$str);
    $str = preg_replace("/\<font(.*?)color=\"#([^ >]+)\"(.*?)\>(.*?)<\/font>/i","<font$1$3>[color=$2]$4[/color]</font>",$str);
    $str = preg_replace("/\<font(.*?)face=\"([^ >]+)\"(.*?)\>(.*?)<\/font>/i","<font$1$3>[face=$2]$4[/face]</font>",$str);
    $str = preg_replace("/\<font(.*?)size=\"([^ >]+)\"(.*?)\>(.*?)<\/font>/i","[size=$2]$4[/size]",$str);
    $str = preg_replace("/\<img[^>]+src=\"([^\"]+)\"[^>]*\>/i","[img]$1[/img]",$str);
    $str = preg_replace("/\<DIV[^>]+ALIGN=\"([^\"]+)\"[^>]*\>(.*?)<\/DIV\>/i","[align=$1]$2[/align]",$str);
    $str = preg_replace("/\<([\/]?)u\>/i","[$1u]",$str);
    $str = preg_replace("/\<([\/]?)em\>/i","[$1I]",$str);
    $str = preg_replace("/\<([\/]?)strong\>/i","[$1b]",$str);
    $str = preg_replace("/\<([\/]?)b(.*?)\>/i","[$1b]",$str);
    $str = preg_replace("/\<([\/]?)i\>/i","[$1i]",$str);
    $str = preg_replace("/<[^>]*?>/i","",$str);
    return $str;
}
?>
