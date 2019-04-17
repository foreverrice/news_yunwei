<?php

	Class SDK
	{
		private static $getPostByTagURL = 'http://news.ci123.com/open/getPostByTag.php';
		private static $appid = APPID;
		private static $appkey = APPKEY;

		public static function request( $url , $params = array(), $method = 'POST' , $multi = false, $extheaders = array())
		{
			if(!function_exists('curl_init')) exit('Need to open the curl extension');
			$method = strtoupper($method);
			$ci = curl_init();
			curl_setopt($ci, CURLOPT_USERAGENT, md5("MAMAGOU_OPEN_PROJECT"));
			curl_setopt($ci, CURLOPT_CONNECTTIMEOUT, 3);
			curl_setopt($ci, CURLOPT_TIMEOUT, 3);
			curl_setopt($ci, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ci, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ci, CURLOPT_SSL_VERIFYHOST, false);
			curl_setopt($ci, CURLOPT_HEADER, false);
			$headers = (array)$extheaders;
			switch ($method)
			{
				case 'POST':
					curl_setopt($ci, CURLOPT_POST, TRUE);
					if (!empty($params))
					{
						if($multi)
						{
							foreach($multi as $key => $file)
							{
								$params[$key] = '@' . $file;
							}
							curl_setopt($ci, CURLOPT_POSTFIELDS, $params);
							$headers[] = 'Expect: ';
						}
						else
						{
							curl_setopt($ci, CURLOPT_POSTFIELDS, http_build_query($params));
						}
					}
					break;
				case 'DELETE':
				case 'GET':
					$method == 'DELETE' && curl_setopt($ci, CURLOPT_CUSTOMREQUEST, 'DELETE');
					if (!empty($params))
					{
						$url = $url . (strpos($url, '?') ? '&' : '?')
							. (is_array($params) ? http_build_query($params) : $params);
					}
					break;
			}
			curl_setopt($ci, CURLINFO_HEADER_OUT, TRUE );
			curl_setopt($ci, CURLOPT_URL, $url);
			if($headers)
			{
				curl_setopt($ci, CURLOPT_HTTPHEADER, $headers );
			}

			$response = curl_exec($ci);
			curl_close ($ci);
			return $response;
		}

		public static function getClientIp()
		{
			if (getenv ( "HTTP_CLIENT_IP" ) && strcasecmp ( getenv ( "HTTP_CLIENT_IP" ), "unknown" ))
				$ip = getenv ( "HTTP_CLIENT_IP" );
			else if (getenv ( "HTTP_X_FORWARDED_FOR" ) && strcasecmp ( getenv ( "HTTP_X_FORWARDED_FOR" ), "unknown" ))
				$ip = getenv ( "HTTP_X_FORWARDED_FOR" );
			else if (getenv ( "REMOTE_ADDR" ) && strcasecmp ( getenv ( "REMOTE_ADDR" ), "unknown" ))
				$ip = getenv ( "REMOTE_ADDR" );
			else if (isset ( $_SERVER ['REMOTE_ADDR'] ) && $_SERVER ['REMOTE_ADDR'] && strcasecmp ( $_SERVER ['REMOTE_ADDR'], "unknown" ))
				$ip = $_SERVER ['REMOTE_ADDR'];
			else
				$ip = "unknown";
			return ($ip);
		}

		public static function getPostsByTag($tag, $page, $pagesize)
		{
			$data = array(
				'appid'		=> self::$appid,
				'appkey'	=> self::$appkey,
				'tag'		=> $tag,
				'page'		=> $page, 
				'pagesize'	=> $pagesize
			);
			return self::request(self::$getPostByTagURL, $data);
		}
	}
?>
