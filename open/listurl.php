<?php
include_once('inc/init.php');
$sql = "SELECT `ID` FROM `news_posts` WHERE `post_status` = 'publish' ORDER BY `ID` ASC";
$data = Db::getRows($sql);

foreach ($data as $d)
{
	echo "http://news.ci123.com/article/".$d['ID'].".html<br />";
}
