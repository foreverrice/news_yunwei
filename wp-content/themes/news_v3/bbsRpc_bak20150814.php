<?php
		include_once('xmlrpc.php');

		$rpc = new xmlrpc_client("http://bbs.ci123.com/rpc/getServer.php", "bbs");
		$bbsdata = $rpc->call("getIndexHot");

		echo json_encode($bbsdata);