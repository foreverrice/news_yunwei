<?php
$dbhost = '127.0.0.1';
$dbport = '3346';
$dbuser = 'news';
$dbpass = 'newsnoc';
$dbname = 'news';
Db::connect($dbhost, $dbport, $dbuser, $dbpass);
Db::selectDb($dbname);
Db::query('set names utf8');
?>
