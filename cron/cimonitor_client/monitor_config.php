<?php
/*
 * @author:qindc
 * @date:2015-09-06
 * @abstract:监控的配置文件，引用项目本身的配置文件，把mysql，memcache，redis等配置引入，在此配置监控用的常量。
 */
define('PROJECT_ID',149);//当前项目id，从abc的项目管理后台中获取，后期以这个标注项目


//数据库配置
include_once('../inc/config.php');

define("MC_DB_USERNAME",DB_USERNAME);
define("MC_DB_PASSWORD",DB_PASSWORD);
define("MC_DB_HOST",DB_HOST);
define("MC_DB_DATABASE",DB_NAME);

define("MC_DB_USERNAME_SLAVE",DB_SLAVE_USERNAME);
define("MC_DB_PASSWORD_SLAVE",DB_SLAVE_PASSWORD);
define("MC_DB_HOST_SLAVE",DB_SLAVE_HOST);
define("MC_DB_DATABASE_SLAVE",DB_SLAVE_NAME);

//Redis 配置
//define("MC_REDIS_HOST",REDIS_HOST);
//define("MC_REDIS_PORT",REDIS_PORT);

//define("MC_REDIS_HOST_SLAVE",REDIS_HOST);
//define("MC_REDIS_PORT_SLAVE",REDIS_PORT);


//memcache 配置
//include('../../config.php');
//define("MC_MEMCACHE_HOST",MEMCACHE_HOST);
//define("MC_MEMCACHE_PORT",11211);

//define("MC_MEMCACHE_HOST_SLAVE",MEMCACHE_HOST);
//define("MC_MEMCACHE_PORT_SLAVE",11211);
