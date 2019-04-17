<?
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

	$post_id = $_POST['post_id'];

	if(!$post_id){
		echo json_encode(
				array(
					'response'	=> '0',
					'errormsg'	=> 'Error: The post_id is not exist!'
				)
			);
		die();
	}

		
	$post = C::getPostContentByID($post_id);
	
	if (!$post)
	{
		echo json_encode(
				array(
					'response'	=> '0',
					'errormsg'	=> 'Error: No posts!'
				)
			);
		die();
	}

	echo json_encode(
		array(
			'response'	=> '1',
			'post'		=> $post
		)
	);
?>
