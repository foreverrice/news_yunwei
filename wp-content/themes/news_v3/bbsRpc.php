<?php
include_once('xmlrpc.php');

$rpc = new xmlrpc_client("http://bbs.ci123.com/rpc/getServer.php", "bbs");
$bbsdata = $rpc->call("getIndexHot",'');
$data = json_encode($bbsdata);

$cache_file = "bbsRpc.cache";
$cache_time = filectime($cache_file);
if($cache_time<(time()-600)){
	$f = fopen("bbsRpc.cache","w+");
	fwrite($f,$data);
	fclose($f);
}

$echo_data = file_get_contents($cache_file);
echo $echo_data;

