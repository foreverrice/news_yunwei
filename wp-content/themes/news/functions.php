<?php
//require_once(TEMPLATEPATH . '/option.php');

//标签nofollow
add_filter('the_tags', 'cis_nofollow_the_tag');
function cis_nofollow_the_tag($text) {
	return str_replace('rel="tag"', 'rel="tag nofollow"', $text);
}

//添加缩略图支持
if ( function_exists( 'add_theme_support' ) ) {
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'jarainx', 150 , 150 ); 
}

function the_titlenum($arg,$num){
    $title0= get_the_title();
    if(mb_strlen($title0,'UTF-8')>$arg) {
    $title1= mb_substr($title0,0,$num,'UTF-8');
    echo $title1;
    echo "...";
    } 
    else {
    echo $title0;
    }
}

function wp_navigation_list(){
        global $wpdb;
        $cat = $wpdb->get_results(" SELECT term_id FROM $wpdb->term_taxonomy  WHERE taxonomy='category' AND parent='0' ");//读取主分类ID
            foreach ((array)$cat as $cat1){
                $get_name = get_category($cat1->term_id);//获取分类
                $name = $get_name ->name ;//获取分类名
                $url = get_category_link($cat1->term_id);//获取分类网址
		$related = $wpdb->get_results("
			SELECT post_title, ID
			FROM {$wpdb->prefix}posts, {$wpdb->prefix}term_relationships, {$wpdb->prefix}term_taxonomy
			WHERE {$wpdb->prefix}posts.ID = {$wpdb->prefix}term_relationships.object_id
			AND {$wpdb->prefix}term_taxonomy.taxonomy = 'category'
			AND {$wpdb->prefix}term_taxonomy.term_taxonomy_id = {$wpdb->prefix}term_relationships.term_taxonomy_id
			AND {$wpdb->prefix}posts.post_status = 'publish'
			AND {$wpdb->prefix}posts.post_type = 'post'
			AND {$wpdb->prefix}term_taxonomy.term_id = '" . $cat1-> term_id . "'
			AND {$wpdb->prefix}posts.ID != '" . $post->ID . "'
			ORDER BY {$wpdb->prefix}posts.ID DESC
			LIMIT 10");
		echo '<div id="list-content"><h3><a href="'.$url.'">'.$name.'</a></h3>';
		echo '</div><div class="clear"></div>';
		if ( $related ) {
    		foreach ($related as $related_post) {
		echo '<li><a href="'.get_permalink($related_post->ID).'" rel="bookmark" title="'.$related_post->post_title.' ">'.$related_post->post_title.'</a></li>';
		}
              }
           }
}


/*替换标点*/
function jr_place($str){
preg_replace("/\"/","/\'" ,$str);
}


/*解决截取汉字乱码*/
function cut_str($sourcestr,$cutlength)
{
$returnstr="";
$i=0;
$n=0;
$str_length=strlen($sourcestr);//字符串的字节数
while (($n<$cutlength) and ($i<=$str_length))
{
$temp_str=substr($sourcestr,$i,1);
$ascnum=Ord($temp_str);//得到字符串中第$i位字符的ascii码
if ($ascnum>=224)//如果ASCII位高与224，
{
$returnstr=$returnstr.substr($sourcestr,$i,3); //根据UTF-8编码规范，将3个连续的字符计为单个字符
$i=$i+3;//实际Byte计为3
$n++;//字串长度计1
}
elseif ($ascnum>=192) //如果ASCII位高与192，
{
$returnstr=$returnstr.substr($sourcestr,$i,2); //根据UTF-8编码规范，将2个连续的字符计为单个字符
$i=$i+2;//实际Byte计为2
$n++;//字串长度计1
}
elseif ($ascnum>=65 && $ascnum<=90) //如果是大写字母，
{
$returnstr=$returnstr.substr($sourcestr,$i,1);
$i=$i+1;//实际的Byte数仍计1个
$n++;//但考虑整体美观，大写字母计成一个高位字符
}
else//其他情况下，包括小写字母和半角标点符号，
{
$returnstr=$returnstr.substr($sourcestr,$i,1);
$i=$i+1;//实际的Byte数计1个
$n=$n+0.5;//小写字母和半角标点等与半个高位字符宽…
}
}
if ($str_length>$cutlength){
$returnstr = $returnstr . "…";//超过长度时在尾处加上省略号
}
return $returnstr;
}
//判断子分类

function get_category_parent($parent) {

global $cat;

$parent = get_category($cat);

if($parent->parent) return ture;

else return false;

}


	if ( function_exists('register_sidebar') )

	register_sidebar(array(

		'before_widget' => '<li id="%1$s" class="widget %2$s">',

		'after_widget' => '</li>',

		'before_title' => '<h4>',

		'after_title' => '</h4>',
	));


// 自定义菜单

	register_nav_menus(array('header-menu' => __( 'header-menu' )));


/*

* 获取当前文章或页面别名的函数

*/

function the_slug() {

    $post_data = get_post($post->ID, ARRAY_A);

    $slug = $post_data['post_name'];

    return $slug;

};

/*

* 获取当前文章所属第一个分类别名的函数

*/

function the_category_slug(){

 $category = get_the_category();

 return ($category ? $category[0]->slug : "");

};

function get_category_root_id($cat) {

	$this_category = get_category($cat);   // 取得当前分类

while($this_category->category_parent) // 若当前分类有上级分类时，循环

{

	$this_category = get_category($this_category->category_parent); // 将当前分类设为上级分类（往上爬）

}

	return $this_category->term_id; // 返回根分类的id

};

//获取缩略图
function catch_that_image() {
	global $post, $posts;
	$first_img = '';
	ob_start();
	ob_end_clean();
	$output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
	$first_img = $matches [1] [0];
	//if(empty($first_img)){ 
	//$first_img = bloginfo('template_url'). '/images/default.jpg';
	//}
	return $first_img;
	}

function par_pagenavi($range = 9){
	global $paged, $wp_query;
	if ( !$max_page ) {$max_page = $wp_query->max_num_pages;}
	if($max_page > 1){if(!$paged){$paged = 1;}
	if($paged != 1){echo "<a href='" . get_pagenum_link(1) . "' class='extend' title='跳转到首页'> 首页 </a>";}
	previous_posts_link(' <上一页 ');
    if($max_page > $range){
		if($paged < $range){for($i = 1; $i <= ($range + 1); $i++){echo "<a href='" . get_pagenum_link($i) ."'";
		if($i==$paged)echo " class='current'";echo ">$i</a>";}}
    elseif($paged >= ($max_page - ceil(($range/2)))){
		for($i = $max_page - $range; $i <= $max_page; $i++){echo "<a href='" . get_pagenum_link($i) ."'";
		if($i==$paged)echo " class='current'";echo ">$i</a>";}}
	elseif($paged >= $range && $paged < ($max_page - ceil(($range/2)))){
		for($i = ($paged - ceil($range/2)); $i <= ($paged + ceil(($range/2))); $i++){echo "<a href='" . get_pagenum_link($i) ."'";if($i==$paged) echo " class='current'";echo ">$i</a>";}}}
    else{for($i = 1; $i <= $max_page; $i++){echo "<a href='" . get_pagenum_link($i) ."'";
    if($i==$paged)echo " class='current'";echo ">$i</a>";}}
	next_posts_link(' 下一页> ');
    if($paged != $max_page){echo "<a href='" . get_pagenum_link($max_page) . "' class='extend' title='跳转到最后一页'> 尾页 </a>";}}
}















/**
 * 获得热评文章
 */
function popular_posts($termId = 0, $page = 1, $posts_num = 10, $days = 7, $orderby = '`post_date` DESC')
{
	global $wpdb;

	$limit = ($page - 1) * $posts_num;

	//所有热评文章
	if ($termId == 0 || $termId == 45)
	{
		$sql = "SELECT `ID` , `post_title` , `comment_count` FROM $wpdb->posts INNER JOIN $wpdb->term_relationships ON ($wpdb->posts.`ID` = $wpdb->term_relationships.`object_id`) INNER JOIN $wpdb->term_taxonomy ON ($wpdb->term_relationships.`term_taxonomy_id` =  $wpdb->term_taxonomy.`term_taxonomy_id`) WHERE 1=1 AND $wpdb->term_taxonomy.`taxonomy` = 'category' AND $wpdb->term_taxonomy.`term_id` != '45' AND $wpdb->posts.`post_status` = 'publish' GROUP BY $wpdb->posts.`ID` ORDER BY ".$orderby." LIMIT $limit , $posts_num  ";
	}
	//分类热评文章
	else
	{
		$sql = "SELECT `ID` , `post_title` , `comment_count` FROM $wpdb->posts INNER JOIN $wpdb->term_relationships ON ($wpdb->posts.`ID` = $wpdb->term_relationships.`object_id`) INNER JOIN $wpdb->term_taxonomy ON ($wpdb->term_relationships.`term_taxonomy_id` =  $wpdb->term_taxonomy.`term_taxonomy_id`) WHERE 1=1 AND $wpdb->term_taxonomy.`taxonomy` = 'category' AND $wpdb->term_taxonomy.`term_id` = $termId AND $wpdb->posts.`post_status` = 'publish' GROUP BY $wpdb->posts.`ID` ORDER BY ".$orderby." LIMIT $limit , $posts_num  ";
	}
	$posts = $wpdb->get_results($sql);
	$output = "";
	foreach ($posts as $post)
	{
		$overPost = $post->post_title;
		$output .= "\n<li><a href= \"".get_permalink($post->ID)."\" rel=\"bookmark\" title=\"".$post->post_title."\" >".$overPost."</a></li>";
	}
	echo $output;
}

/**
 *新首页的热评文章
 */
 function popular_posts_new($termId = 0, $page = 1, $posts_num = 10, $days = 7, $orderby = '`post_date` DESC')
{
	global $wpdb;

	$limit = ($page - 1) * $posts_num;

	//所有热评文章
	if ($termId == 0 || $termId == 45)
	{
		$sql = "SELECT `ID` , `post_title` , `comment_count` FROM $wpdb->posts INNER JOIN $wpdb->term_relationships ON ($wpdb->posts.`ID` = $wpdb->term_relationships.`object_id`) INNER JOIN $wpdb->term_taxonomy ON ($wpdb->term_relationships.`term_taxonomy_id` =  $wpdb->term_taxonomy.`term_taxonomy_id`) WHERE 1=1 AND $wpdb->term_taxonomy.`taxonomy` = 'category' AND $wpdb->term_taxonomy.`term_id` != '45' AND $wpdb->posts.`post_status` = 'publish' GROUP BY $wpdb->posts.`ID` ORDER BY ".$orderby." LIMIT $limit , $posts_num  ";
	}
	//分类热评文章
	else
	{
		$sql = "SELECT `ID` , `post_title` , `comment_count` FROM $wpdb->posts INNER JOIN $wpdb->term_relationships ON ($wpdb->posts.`ID` = $wpdb->term_relationships.`object_id`) INNER JOIN $wpdb->term_taxonomy ON ($wpdb->term_relationships.`term_taxonomy_id` =  $wpdb->term_taxonomy.`term_taxonomy_id`) WHERE 1=1 AND $wpdb->term_taxonomy.`taxonomy` = 'category' AND $wpdb->term_taxonomy.`term_id` = $termId AND $wpdb->posts.`post_status` = 'publish' GROUP BY $wpdb->posts.`ID` ORDER BY ".$orderby." LIMIT $limit , $posts_num  ";
	}
	$posts = $wpdb->get_results($sql);
	$output = "";
	foreach ($posts as $key => $val)
	{	
		$overPost = $posts[$key]->post_title;
		$output .= "<dd><span>".($key+1)."</span><a href=\"".get_permalink($posts[$key]->ID)."\">".$overPost."</a></dd>";
	}
	echo $output;
}









/**
 * 删除菜单
 */
function remove_menus()
{
    global $menu;
    $restricted = array(
		//__('Dashboard'),
		//__('Posts'),
		//__('Media'),
		__('Links'),
		__('Pages'),
		//__('Appearance'),
		__('Tools'),
		//__('Users'),
		//__('Settings'),
		//__('Comments'),
		//__('Plugins')
	);
    end ($menu);
    while (prev($menu))
	{
        $value = explode(' ', $menu[key($menu)][0]);
        if (in_array($value[0] != NULL ? $value[0] : "", $restricted))
		{
			unset($menu[key($menu)]);
		}
    }
}

/**
 * 删除子菜单
 */
function remove_submenu()
{
    remove_submenu_page( 'index.php', 'update-core.php' );
    remove_submenu_page( 'ci123.php', 'ci123.php' );
}

/**
 * 添加菜单菜单
 */
function add_menus()
{
    add_menu_page('推荐管理', '推荐管理', 'administrator', 'ci123-home-toutiao.php','','', 99);
	add_submenu_page( 'ci123-home-toutiao.php', '首页头条', '首页头条', 'administrator', 'ci123-home-toutiao.php', '');
	add_submenu_page( 'ci123-home-toutiao.php', '标签组', '标签组', 'administrator', 'ci123-home-groups.php', '');
	add_submenu_page( 'ci123-home-toutiao.php', '图说', '图说', 'administrator', 'ci123-glb-right-photo.php', '');
	//add_submenu_page( 'ci123-topSlider.php', '全局右侧图片新闻', '全局右侧图片新闻', 'administrator', 'ci123-glb-right-photo.php', '');
	
	add_submenu_page( 'ci123-home-toutiao.php', '首页视频', '首页视频', 'administrator', 'ci123-home-groups-vedio.php', '');
	add_submenu_page( 'ci123-home-toutiao.php', '育儿视点', '育儿视点', 'administrator', 'ci123-home-shidian.php', '');
	add_menu_page('CNZZ统计', 'CNZZ统计', 'administrator', 'ci123-cnzz.php','','', 100);
	add_menu_page('点击统计', '点击统计', 'administrator', 'ci123-click-record.php','','', 101);
}

if ( is_admin() )
{
	add_action('admin_menu', 'add_menus');
    add_action('admin_menu', 'remove_menus');
	add_action('admin_menu', 'remove_submenu');
}









//然后将下面的代码放到myplugin/myplugin-index.php文件中

//echo "Admin Page Test";

//或者使用下面方法
/*
add_action('admin_menu', 'register_custom_menu_page');

function register_custom_menu_page()
{
    add_menu_page('菜单标题', '菜单名称', 'administrator', 'custompage', 'custom_menu_page', plugins_url('myplugin/images/icon.png'), 6);
}

function custom_menu_page(){
    echo "Admin Page Test";
}
*/

function get_via_link($post){

    $via = explode(";", get_post_meta($post->ID, "via", true));
    $via_name = $via[0]; 
    $via_link = $via[1];
    if($via_name!="")
    {
	echo "<p class=\"tips mgt10\">(本资讯转自<".$via_name.">)</p>";
    }
    else
    {
        echo "<p class=\"tips mgt10\">(本资讯由<a href=\"http://www.ci123.com/\" target=\"_blank\">育儿网</a>原创，转载请注明来自育儿网，并链回本页)</p>";
    }
}
//add_theme_support( 'post-thumbnails' ); 
//set_post_thumbnail_size( '150', '150', false );

/*
function custom_posts_per_page($query)
{
    if ($query->query_vars['category_name'] == 'album')
	{
        $query->set('posts_per_page', 30);
	}
	if (is_home())
	{
		$query->set('cat=-45');
	}
}

add_action('pre_get_posts','custom_posts_per_page');
*/


/**
 * 获取文章第一张图
 */
function getFirstImage($postId, $width, $height)
{
	$args = array(
		'numberposts' => 1,
		'order'=> 'ASC',
		'post_mime_type' => 'image',
		'post_parent' => $postId,
		'post_status' => null,
		'post_type' => 'attachment'
	);
	$attachments = get_children($args);

	if(!$attachments)
	{
		return '<img src="http://news.ci123.com/images/96.jpg" alt="' . the_title('', '', false) . '" width="'.$width.'" height="'.$height.'" />';
	}
 
	$image = array_pop($attachments);
	$imageSrc = wp_get_attachment_image_src($image->ID, 'thumbnail');
	$imageUrl = $imageSrc[0];
	$html = '<img src="' . $imageUrl . '" alt="' . the_title('', '', false) . '" width="'.$width.'" height="'.$height.'" />';
	return $html;
}

?>
