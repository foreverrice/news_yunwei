<?php
    ini_set('display_errors', 'on');
    error_reporting(E_ALL);
    //exec('cd /opt/ci123/www/html/news/cron;/opt/ci123/php/bin/php createRss_qutoutiao.php');
    //$r = exec("cd /opt/ci123/www/html/news/cron; /opt/ci123/php/bin/php createRss_qutoutiao.php >> createRss_qutoutiao.log;", $a);
    $r = exec("/opt/ci123/php/bin/php /opt/ci123/www/html/news/cron/createRss_qutoutiao.php");
    var_dump($r);
?>
