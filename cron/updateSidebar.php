<?php
include_once("/opt/ci123/www/html/news/wp-content/themes/news_v3/xmlrpc.php");

//更新百科的关键词推荐
$xmlrpc = new  xmlrpc_client("http://www.ci123.com/baike/rpc/keywordsServer.php","baike");
$result = @$xmlrpc->call("getKeywords");
$data = json_encode($result);

$cache_file = "/opt/ci123/www/html/news/wp-content/themes/news_v3/keywords.cache";
$f = fopen($cache_file,"w+");
fwrite($f,$data);
fclose($f);


//更新论坛的热帖推荐
$rpc = new xmlrpc_client("http://bbs.ci123.com/rpc/getServer.php", "bbs");
$bbsdata = $rpc->call("getIndexHot",'');
$data = json_encode($bbsdata);

$cache_file = "/opt/ci123/www/html/news/wp-content/themes/news_v3/bbsRpc.cache";
$f = fopen($cache_file,"w+");
fwrite($f,$data);
fclose($f);

