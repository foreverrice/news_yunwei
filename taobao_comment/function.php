<?php 
	require_once("Http.class.php");
	function collect_one($iid) {
        $seller =get_seller_id($iid);
        if (!$seller['id']) return false;
        if ($seller['type'] == 'tmall') {
			for($i=1;$i<=2;$i++)
			{
				$rate_tmall_api ='http://rate.tmall.com/list_detail_rate.htm?itemId='.$iid.'&sellerId='.$seller['id'].'&order=1&forShop=1&append=0&currentPage='.$i;
				$source = Http::fsockopenDownload($rate_tmall_api);
				if($source)
				{
					$source = rtrim(ltrim(trim($source), '('), ')');
					$source = iconv('GBK', 'UTF-8//IGNORE', $source);
					$source = str_replace('"rateDetail":', '', $source);
					$rate_resp = json_decode($source, true);
					$rate_list = $rate_resp['rateList'];
					foreach($rate_list as $val)
					{   
						if(mb_strlen($val['rateContent'],'UTF-8')>10)
						{
							if(check_content($val['rateContent']))
							{
								$comments[]=nl2br($val['rateContent']);
								$date[] =  $val['rateDate'];
								$rateId[] = $val['id'];
							}
						}
					}
					
				}
			}
         } else {
			for($i=1;$i<=2;$i++)
			{
				$rate_taobao_api = 'http://rate.taobao.com/feedRateList.htm?userNumId='.$seller['id'].'&auctionNumId='.$iid.'&siteID=4&currentPageNum='.$i.'&rateType=1&orderType=feedbackdate&showContent=1&attribute=';
				$source = Http::fsockopenDownload($rate_taobao_api);
				if($source)
				{
					$source = rtrim(ltrim(trim($source), '('), ')');

					$source = iconv('GBK', 'UTF-8//IGNORE', $source);
					$rate_resp = json_decode($source, true);
					$rate_list = $rate_resp['comments'];
					foreach($rate_list as $key=>$val)
						{
							if(mb_strlen($val['content'],'UTF-8')>10)
							{
								if(check_content($val['content']))
								{
									$comments[]=nl2br($val['content']);
									$date[]  =  changtime($val['date']);
									$rateId[] = $val['rateId'];
								}
							}
						}
					
				}
			 }
        }
		foreach($comments as $key=>$val)
		{
			$data[$key]["comment"]=$val;
		}
		foreach($date as $key=>$val)
		{
			$data[$key]["date"]=$val;
		}
		foreach($rateId as $key=>$val)
		{
			$data[$key]["rateId"]=$val;
		}
		return $data;
    }
	//collect_one(19203284670);
	//var_dump(collect_one(19203284670));//淘宝
	//var_dump(collect_one(16998134885));//天猫
    /**
     * 获取商品卖家ID
     */
    function get_seller_id($iid) {
        $result = array('type'=>'taobao', 'id'=>0);
        $page_content = Http::fsockopenDownload('http://item.taobao.com/item.htm?id='.$iid);
        if (!$page_content) {
            //$page_content = Http::fsockopenDownload('http://detail.tmall.com/item.htm?id='.$iid);
            $page_content = file_get_contents('http://detail.tmall.com/item.htm?id='.$iid);
            $result['type'] = 'tmall';
        }
        //preg_match('|; userid=(\d+);">|', $page_content, $out);
        preg_match_all("/; userid=(\d+);/",$page_content, $out);
		//var_dump($out);
        $result['id'] = $out[1][0];
        return $result;
    }
	function changtime($date)
	{
		 $date = str_replace("年","-",$date);
		 $date = str_replace("月","-",$date);
		 $date = str_replace("日","",$date);
		 return $date;

	}
	function check_content($string)
	{
		if($string=="此用户没有填写评论!"||$string=="评价方未及时做出评价,系统默认好评!")
		{
			return false;
		}else{
			if (hasURL($string))
			{
				return false;
			}else{
				return true;
			}
		}

	}
	function hasURL($subject)
	{   
		return preg_match('/[\w]+(com|net|org|info|biz|cc|cn|hk)/i', preg_replace('/(\W)/','',$subject)) ? true:false;
	}
 
   ?>