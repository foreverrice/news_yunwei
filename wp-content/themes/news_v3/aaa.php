<?php

$bbsdata = json_decode(file_get_contents("./bbsRpc.cache"));
$baikedata = json_decode(file_get_contents("./keywords.cache"));
var_dump($bbsdata,$baikedata);
