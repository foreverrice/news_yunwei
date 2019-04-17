<?php
include_once("xmlrpc.php");
$xmlrpc = new  xmlrpc_client("http://www.ci123.com/baike/rpc/keywordsServer.php","baike");
$result = @$xmlrpc->call("getKeywords");
$data = json_encode($result);

$cache_file = "keywords.cache";
$cache_time = filectime($cache_file);
if($cache_time<(time()-600)){
	$f = fopen($cache_file,"w+");
	fwrite($f,$data);
	fclose($f);
}

$echo_data = file_get_contents($cache_file);
echo $echo_data;
