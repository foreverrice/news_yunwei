<?php
	include_once('inc/init.php');

	if (!$_POST)
	{
		echo json_encode(
				array(
					'response'	=> '0',
					'errormsg'	=> 'Error: No Post Param!'
				)
			);
		die();
	}

	// 权限验证
	$config = array(
		'appid'		=> $_POST['appid'],
		'appkey'	=> $_POST['appkey']
	);

	if (($config['appid'] != 'newsopen') || ($config['appkey'] != '57508c6c099b23b61beb46bb7be6a29a'))
	{
		echo json_encode(
				array(
					'response'	=> '0',
					'errormsg'	=> 'Error: Illegal Appid & Appkey!'
				)
			);
		die();
	}

	$tag = $_POST['tag'];
	$page = $_POST['page'];
	$limit = $_POST['limit'] ? $_POST['limit'] : 10;

	// 标签id
	$tag_id = C::getTagId($tag);

	if (!$tag_id)
	{
		echo json_encode(
				array(
					'response'	=> '0',
					'errormsg'	=> 'Error: The tag is not exist!'
				)
			);
		die();
	}

	// 获取文章
	$posts = C::getPostsByTagID($tag_id, $page, $limit);

	// 获取文章总数
	$postsnum = C::getPostsNumByTagID($tag_id);

	if (!$posts)
	{
		echo json_encode(
				array(
					'response'	=> '1',
					'posts'		=> '0'
				)
			);
		die();
	}

	echo json_encode(
		array(
			'response'	=> '1',
			'posts'		=> $posts,
			'postsnum'	=> $postsnum
		)
	);
?>
