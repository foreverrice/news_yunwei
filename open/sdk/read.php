<?php
	/**
	 * news.ci123.com 开放接口
	 */
	include_once('sdk.php');
	
	define('APPID', 'newsopen');
	define('APPKEY', '57508c6c099b23b61beb46bb7be6a29a');

	// 根据标签获取文章
	$tag = '业界快讯';
	$page = 1;
	$pagesize = 10;
	$response = json_decode(SDK::getPostsByTag($tag, $page, $pagesize));
	
	if (!$response->response)
	{
		echo $response->errormsg;
	}
	else
	{
		// 文章总数
		echo $response->postsnum;
		echo "<br /><br /><br />";

		// 当前页数
		echo $response->currpage;
		echo "<br /><br /><br />";

		// 文章内容
		foreach ($response->posts as $post)
		{
			var_dump($post);
			echo "<br /><br /><br />";
		}
	}	