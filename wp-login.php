<?php
require( dirname(__FILE__) . '/wp-load.php' );
if (isset($_GET['action']) && $_GET['action'] == 'duoshuo_login')
{
	$redirectTo = isset($_GET['redirect_to']) ? urldecode($_GET['redirect_to']) : 'http://news.ci123.com/';
	echo "<script>window.location='".$redirectTo."';</script>";	
	exit;
}
else
{
	header('HTTP/1.1 404 Not Found');
	include(dirname(__FILE__).'/wp-content/themes/news.ci123.com/404.php');
	exit;
}
?>
