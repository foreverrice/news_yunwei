<?php
include_once("xmlrpc.php");
$xmlrpc = new  xmlrpc_client("http://www.ci123.com/baike/rpc/keywordsServer.php","baike");
$result = $xmlrpc->call("getKeywords");
echo json_encode($result);
