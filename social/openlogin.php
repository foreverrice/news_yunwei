<?php
/*
*已登录返回数组:包含退出链接以及当前登录用户名
*如果退出之后要跳转到指定页面请传back_url
*未登录则跳转登录，默认返回当前页面，如果要跳转到其他页面，请传back_url
*该函数之前不能有输出，因为需要使用session
*项目编号由tool.ci123.com中统一分配，之后不可再修改
*/
header("content-type:text/html;charset=utf-8;");

function needLogin($back_url=''){
	$project_id = 23;//每个项目的编号，由tool.ci123.com中统一分配
	if(!isset($_SESSION)){
		session_start();
	}
	$back_url = $back_url?$back_url:"http://".$_SERVER['HTTP_HOST'].$_SERVER["REQUEST_URI"];
	$back_url = urlencode($back_url);
	$result['logout_url'] = "http://tool.ci123.com/alexastats/openlogout.php?project_id={$project_id}&back_url={$back_url}";
		
	$altstr = '';
	if(isset($_COOKIE['openname']) && isset($_COOKIE['openstr']) && $_SESSION['openProjectStr']){//只有当两次的session相同才算有权限
		$openStr = explode(",",$_SESSION['openProjectStr']);
		if(($openStr[1] == $_COOKIE['openstr'])){
			if($openStr[0] == $project_id){
				$result['openname'] = $_COOKIE['openname'];
				return $result;
			}else{
				//$altstr = "alert('You do not have permission to the project');";
			}
		}
	}
	$postdata = "project_id=".$project_id;
	$data = httpPost("http://tool.ci123.com/alexastats/openlogServer.php?rid=".mt_rand(10000,99999),$postdata);
	if($data){
		$_SESSION['openProjectStr'] = $data;
	}else{
		$altstr = "alert('服务器配置问题，请联系相应技术员');";
	}
	echo "<script>{$altstr}window.location='http://tool.ci123.com/alexastats/openlogin.php?back_url={$back_url}&project_id={$project_id}';</script>";
	die();
}
function httpPost($url,$vars ='') {
	if (!function_exists('curl_init')) {//curl不能使用则通过file_get_contents抓取
		$url = $url."&".$vars;
		$data = '';
		for($i=0;$i<3;$i++){
			$data = file_get_contents($url);
			if($data){
				return $data;
			}
		}
		return $data;
	}
	$ch = curl_init ();//执行POST请求
	curl_setopt($ch, CURLOPT_URL, $url );
	curl_setopt($ch, CURLOPT_POST, 1 );
	curl_setopt($ch, CURLOPT_POSTFIELDS, $vars);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1 );
	$data = curl_exec( $ch );
	curl_close( $ch );
	if($data){
		return $data;
	}
	return false;
}
//$loginfo = needLogin('');//统一登录函数
?>
