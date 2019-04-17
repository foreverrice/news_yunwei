<?php
error_reporting(0);
require_once('./admin.php');

/**
 * 生成上传图片名称
 */
function uploadImageName($prefix)
{	
	if (!$prefix)
	{
		$prefix = 'photo';
	}

	$name = $prefix."_".randomString(5)."_".substr(md5(time()), 16, 16);

	return $name;
}

/**
 * 生成随机字符串
 */
function randomString($len)
{
	$chars = array(
			"a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k",  
			"l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v",  
			"w", "x", "y", "z", "A", "B", "C", "D", "E", "F", "G",  
			"H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R",  
			"S", "T", "U", "V", "W", "X", "Y", "Z", "0", "1", "2",  
			"3", "4", "5", "6", "7", "8", "9"
		      );

	$charsLen = count($chars) - 1;
	shuffle($chars);

	$output = "";

	for ($i=0; $i<$len; $i++)
	{
		$output .= $chars[mt_rand(0, $charsLen)];
	}

	return $output;
}


$headers = apache_request_headers();
$name_header = isset($headers['file_fileName']) ? $headers['file_fileName'] : $headers['file_name'];
$imgType = strtolower(strrchr($name_header, '.'));
$imgName = uploadImageName('upload').$imgType;
$path = '../uploads/'.date("Ymd").'/';
if ( !file_exists( $path ) )
{
	mkdir( "$path" , 0777 );
}
$upload_url = $path.$imgName;
$putdata = fopen("php://input", "r");
$fp = fopen(dirname(__FILE__).'/'.$upload_url, "w");
while ($data = fread($putdata, 1024))
	fwrite($fp, $data);
	fclose($fp);
	fclose($putdata);
	echo 'uploads/'.date("Ymd").'/'.$imgName;
	?>
