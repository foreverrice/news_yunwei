<?php
	require( dirname(__FILE__) . '/wp-load.php' );
	if (htmlspecialchars(trim($_POST['title'])) && htmlspecialchars(trim($_POST['link'])) && htmlspecialchars(trim($_POST['from'])))
	{
		$data = array(
			'title' => htmlspecialchars(trim($_POST['title'])),
			'link'	=> htmlspecialchars(trim($_POST['link'])),
			'from'	=> htmlspecialchars(trim($_POST['from'])),
			'date'	=> time()
		);
		return $wpdb->insert('news_click_record', $data);
	}
	else
	{
		header('HTTP/1.1 404 Not Found');
		include(dirname(__FILE__).'/wp-content/themes/news.ci123.com/404.php');
		exit;
	}
?>
