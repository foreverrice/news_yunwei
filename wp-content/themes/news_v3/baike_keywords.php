<?php
		include_once('xmlrpc.php');
		$xmlrpc = new  xmlrpc_client("http://www.ci123.com/baike/rpc/keywordsServer.php","baike");
		$data = $xmlrpc->call("getKeywords", 1);

		echo json_encode($data);
