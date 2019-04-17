<?php
/**
 * 编    写：袁 亮
 * 时    间：2015-07-14
 * 说    明：应用层，监控报警系统客户端
 */
include_once("monitor_config.php");
include_once("class_xmlrpc.php");

class MonitorBase{
    function __construct(){
        $c = new xmlrpc_client('http://abc.ci123.com/admin/tech/rpc/monitorServer.php','tech/monitor');
        $r = $c->call("runLogs",PROJECT_ID,__FILE__);//执行log，作为后期判断检测脚本是否存活
    }
    /*
     * 将报警监控日志写入到服务端
     * */
	function addLog($p){
		$data = array(
            'project_id'    => PROJECT_ID,//项目编号
            'type'          => $p['type'],//报警类型
            'level'         => $p['level'],//错误级别
            'info'          => $p['info'],//错误提示信息
        );
        $c = new xmlrpc_client('http://abc.ci123.com/admin/tech/rpc/monitorServer.php','tech/monitor');
        $res = $c->call("addLogs",$data);
        echo var_export($data,1)."\n";
        return $res;
    }
    /**
     * mysql数据链接监测
     * */
    function checkMysqlConnect($host,$username,$passwd,$dbname,$info){
        $link = mysql_connect($host,$username,$passwd);
        if($link){
            if(mysql_select_db($dbname,$link)){
                return '数据库'.$dbname."正常{$info}";
            }
        }

        $data = array(
            'type'  => 'mysql/connect',
            'level' => 'fatal',
            'info'  => "{$dbname}连接不上<br>{$info}"
        );
        $this->addLog($data);
        return $data;
    }
    /*
     * redis数据库检测
     * 连接、内存使用、是否可写三种检测
     * */
    function checkRedisBase($host,$port,$max_use=0.95,$check_write=false){
        $rs = new Redis;
        try{
            $res = $rs->connect($host,$port);
            if(!$res){
                $data = array(
                    'type'  => 'redis/connet',
                    'level' => 'fatal',
                    'info'  => $host.':'.$port."的redis链接不上"
                );
                $this->addLog($data);
                return false;
            }
        }catch(Exception $e){
            $data = array(
                'type'  => 'redis/connet',
                'level' => 'fatal',
                'info'  => $host.':'.$port."的redis链接不上"
            );
            $this->addLog($data);
            return false;
        }

        //检测内存是否已经要使用完了
        $data = $rs->config('get','maxmemory');
        $max_mem = $data['maxmemory'];

        $tmp = $rs->info();
        $use_mem = $tmp['used_memory'];
        $use = $use_mem/$max_mem;
        if($use > $max_use){//内存使用过多
            $data = array(
                'type'  => 'redis/mem_use',
                'level' => 'warring',
                'info'  => $host.':'.$port."的redis内存已经使用超过".number_format($use*100,1)."%(".intval($use_mem/1024/1024)."M)，请及时处理"
            );
            $this->addLog($data);
            if(!$check_write){
                return false;
            }
        }

        //检测是否可写入，权限监控
        if($check_write){
            $key = 'monitor_'.time();
            $res = $rs->set($key,time());
            if(!$res){
                $data = array(
                    'type'  => 'redis/set',
                    'level' => 'fatal',
                    'info'  => $host.':'.$port."的redis不能写入，请检查"
                );
                $this->addLog($data);
                return false;
            }
            $rs->delete($key);
        }

        return "redis:{$host}:{$port}检测正常";
    }
    function curl($url,$post_data=array(),$cookie=''){
        $urlinfo = parse_url($url);
        $host = $urlinfo['scheme'].'://'.$urlinfo['host'];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);//不直接输出，作为变量返回
		curl_setopt($ch, CURLOPT_REFERER, $host);//模拟referer，防止被禁止，抓取图片的时候非常有用
		curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.71 Safari/537.36');
		curl_setopt($ch, CURLOPT_TIMEOUT,25);//内容传输的最长时间，一定要设置
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT,25);//连接的最长时间，一定要设置
        if($post_data){
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);//Post提交的数据包
        }
		if($cookie){
			curl_setopt($ch, CURLOPT_COOKIE, $cookie);
		}
        curl_setopt($ch,CURLOPT_HEADER,true);//将头信息输出，默认只输出http的body部分（非html的body）

        return curl_exec($ch);
    }
}

class Monitors extends MonitorBase{
    ///////////////////////////外部资源可用性检查////////////////////////
    /**
     * 检查数据库链接是否正常
     */
    function checkMysql(){
        $res = $this->checkMysqlConnect(MC_DB_HOST,MC_DB_USERNAME,MC_DB_PASSWORD,MC_DB_DATABASE,'主库');
        if(!is_array($res)){
            echo $res."\n";
        }
        $res = $this->checkMysqlConnect(MC_DB_HOST_SLAVE,MC_DB_USERNAME_SLAVE,MC_DB_PASSWORD_SLAVE,MC_DB_DATABASE_SLAVE,'从库');
        if(!is_array($res)){
            echo $res."\n";
        }
    }
    /*
     * 检测redis的可用性，是否可链接，是否可写入，内存是否要满了
     * */
    function checkRedis(){

        $res = $this->checkRedisBase(MC_REDIS_HOST,MC_REDIS_PORT,0.9,1);
        if(!is_array($res)){
            echo $res."\n";
        }
    }
    /*
     * 检测memcache的可用性，是否可链接，是否可写入，内存是否要满了
     * */
    function checkMemcache(){
        $res = $this->checkMemcacheBase(MC_MEMCACHE_HOST,MC_MEMCACHE_PORT,0.9,1);
        if(!is_array($res)){
            echo $res."\n";
        }
    }

    ////////////////////////////应用功能检测//////////////////////////
	/************关键页面是否可以访问***************/
	function checkPageUrl($url,$type='news',$level='notice',$msg='',$len_limit=10000){
		$content = $this->curl($url);
		if(!$content){
			$content = $this->curl($url);
		}
		$len = strlen($content);
		if($len<$len_limit){
			$data = array(
                        'type'  => $type,
                        'level' => $level,
                        'info'  => $msg
			);
			$this->addLog($data);
		}
		return $len;
	}
	function checkIndex(){
		$url = "http://news.ci123.com/";
		$type = "news/index";
		$level = "fatal";
		$msg = "首页内容过短，怀疑页面不正常，请立即查看\r\n页面链接：{$url}";
		$len_limit = 38000;
		$len = $this->checkPageUrl($url,$type,$level,$msg,$len_limit);
		echo "首页:{$len}\r\n";
	}

    function checkOnePage(){
        $url = "http://news.ci123.com/article/95532.html";
        $type = "news/article";
        $level = "fatal";
        $msg = "测试：文章页面内容过短，怀疑页面不正常，请立即查看\r\n页面链接：{$url}";
        $len_limit = 40000;
		$len = $this->checkPageUrl($url,$type,$level,$msg,$len_limit);
		echo "文章页面为:{$len}\r\n";
	}

	function checkListPage(){
		$urls = array(
				'事件播报'=>'http://news.ci123.com/category/event',
				'育儿动态'=>'http://news.ci123.com/category/news',
				'图片新闻'=>'http://news.ci123.com/category/poto',
				'视频报道'=>'http://news.ci123.com/category/video',
				);
		$type = "news/list";
		$level = "fatal";
		$len_limit = 35000;
		$return = '';
		foreach($urls as $name=>$url){
			$msg = $name."内容过短，怀疑页面不正常，请立即查看\r\n页面链接：{$url}";
			$len = $this->checkPageUrl($url,$type,$level,$msg,$len_limit);
			$return .= $name.":".$len."|";
		}
		echo $return."\r\n";
	}
}
