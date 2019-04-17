<?php
/** 
 * WordPress 基础配置文件。
 *
 * 本文件包含以下配置选项：MySQL 设置、数据库表名前缀、密钥、
 * WordPress 语言设定以及 ABSPATH。如需更多信息，请访问
 * {@link http://codex.wordpress.org/zh-cn:%E7%BC%96%E8%BE%91_wp-config.php
 * 编辑 wp-config.php} Codex 页面。MySQL 设置具体信息请咨询您的空间提供商。
 *
 * 这个文件用在于安装程序自动生成 wp-config.php 配置文件，
 * 您可以手动复制这个文件，并重命名为“wp-config.php”，然后输入相关信息。
 *
 * @package WordPress
 */

// ** MySQL 设置 - 具体信息来自您正在使用的主机 ** //
/** WordPress 数据库的名称 */
define( 'WPCACHEHOME', '/opt/ci123/www/html/news/wp-content/plugins/wp-super-cache/' ); //Added by WP-Cache Manager

define('DB_NAME', 'news');

/** MySQL 数据库用户名 */
define('DB_USER', 'news');

/** MySQL 数据库密码 */
define('DB_PASSWORD', 'newsnoc');

/** MySQL 主机 */
define('DB_HOST', '127.0.0.1:3346');

/** 创建数据表时默认的文字编码 */
define('DB_CHARSET', 'utf8');

/** 数据库整理类型。如不确定请勿更改 */
define('DB_COLLATE', '');

/** 安装模板跳过FTP */
define('FS_METHOD', 'direct');

define('WP_CACHE', false); //Added by WP-Cache Manager
define('WP_POST_REVISIONS', false); //禁用历史修订版本
define('AUTOSAVE_INTERVAL', 86400);
/**#@+
 * 身份认证密匙设定。
 *
 * 您可以随意写一些字符
 * 或者直接访问 {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org 私钥生成服务}，
 * 任何修改都会导致 cookie 失效，所有用户必须重新登录。
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'FL4_SnNzaI0Y(:t&r_?f(.K%O.RL ^&4R&aD, fakbkF>W%gK<l|.K>=$)i4$7wl');
define('SECURE_AUTH_KEY',  '%<DVv6=y8(U8lYM2jZ2YZ/(i{lnIrvmut.&H9AQfrB0&cqU(7+Uz{9l(i0zzd7<9');
define('LOGGED_IN_KEY',    '>p-gb*IM8+[!V{A.`nxwguvI0tJ|f>u#(_;r^cW_Tk]iaLo)|H]P+g;#/7k43A&}');
define('NONCE_KEY',        '.@~@xZj&r<#wOG+XF~~!BqWs2cR UuGJ<&5:-j)p?8pjpB, WM1_:nJa<RL%?e.l');
define('AUTH_SALT',        'Q<*f;YX#@j1;,I-h_{B$[)bwRB>4.zG.Yc7CDG4Q Rk&oxHdP^$:t3KMsvwl A/t');
define('SECURE_AUTH_SALT', 'l:M|>C{y%Jqov$I !j8;e/W]hWqnCm@k;vf1*jeU&I*BK^~9]2ZL?.*I~{Y+dDWI');
define('LOGGED_IN_SALT',   'g2.(DjzY69CQh|(LEfO.<Je4ynGdt`dE1a%B<xe-L]lc4A%rI),jNODtd!aF6^JF');
define('NONCE_SALT',       '?@Xjb17 OwaffajPm?LTE(bIBh1AXj-=h]lA&X6l+mHr[7-k/A`!4wdw$sq[V8<H');

/**#@-*/

/**
 * WordPress 数据表前缀。
 *
 * 如果您有在同一数据库内安装多个 WordPress 的需求，请为每个 WordPress 设置不同的数据表前缀。
 * 前缀名只能为数字、字母加下划线。
 */
$table_prefix  = 'news_';

/**
 * WordPress 语言设置，中文版本默认为中文。
 *
 * 本项设定能够让 WordPress 显示您需要的语言。
 * wp-content/languages 内应放置同名的 .mo 语言文件。
 * 要使用 WordPress 简体中文界面，只需填入 zh_CN。
 */
define('WPLANG', 'zh_CN');

/**
 * 开发者专用：WordPress 调试模式。
 *
 * 将这个值改为“true”，WordPress 将显示所有用于开发的提示。
 * 强烈建议插件开发者在开发环境中启用本功能。
 */
define('WP_DEBUG', false);

/**
 * 经常白页的解决方案之一
 * http://www.veryhuo.com/a/view/50984.html
 */
define('WP_MEMORY_LIMIT', '96M');

/* 好了！请不要再继续编辑。请保存本文件。使用愉快！ */

/** WordPress 目录的绝对路径。 */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** 设置 WordPress 变量和包含文件。 */

require_once(ABSPATH . 'wp-settings.php');
