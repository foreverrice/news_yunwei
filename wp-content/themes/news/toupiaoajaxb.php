<?php
	include_once('xmlrpc.php');
	$id = trim($_POST['id']);
	$xuanxiang = trim($_POST['xuanxiang']);

	$xmlrpc_client = new xmlrpc_client('http://www.ci123.com/special/rpc/vote.php', 'view');
	$result = $xmlrpc_client->call('doVote', $id,2);


	$xmlrpc_client = new xmlrpc_client('http://www.ci123.com/special/rpc/vote.php', 'view');
	$result = $xmlrpc_client->call('getVote', $id);
	$data = array(
		'num1'=>$result['num1'],
		'num2'=>$result['num2']

	);
	//var_dump($result);

	echo json_encode($data);
?>