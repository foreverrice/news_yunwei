<?php
ini_set('display_errors','on');
error_reporting(E_ALL);
/**
 定时脚本添加
 #袁亮-2015-07-14添加，定时检查短链系统是否正常
 12 * * * * (cd /opt/ci123/www/html/ciurl/cimonitor_client;/opt/ci123/php/bin/php check_app.php >>/tmp/log_monitor_ciurl; 2>&1)
 */
include_once('monitorClass.php');

if(isset($_SERVER['HTTP_HOST'])){//不允许浏览器访问
    die('error');
}

echo "检测脚本开始".date("Y-m-d H:i:s")."\n";
$c = new Monitors();
$c->checkMysql();//检测数据库
//$c->checkRedis();//检测redis
$c->checkIndex();
$c->checkOnePage();
$c->checkListPage();


echo "检测脚本结束".date("Y-m-d H:i:s")."\n===========================\n";
