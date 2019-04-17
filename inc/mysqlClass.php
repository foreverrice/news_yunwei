<?php
/*
 * 编	写：袁	亮
 * 时	间：2012-3-22
 * 功	能：数据库操作类
 */
class Mysqls{
	protected $dblink;//数据库连接
	protected $config = array('host'=>DB_HOST,'username'=>DB_USERNAME,'password'=>DB_PASSWORD,'dbname'=>DB_NAME);//当前使用
	protected $mconfig = array('host'=>DB_HOST,'username'=>DB_USERNAME,'password'=>DB_PASSWORD,'dbname'=>DB_NAME);//主数据库
	protected $sconfig = array('host'=>DB_SLAVE_HOST,'username'=>DB_SLAVE_USERNAME,'password'=>DB_SLAVE_PASSWORD,'dbname'=>DB_SLAVE_NAME);//slave数据库
	
	function __construct($is_slave=false,$p=array()){
		$this->dblink = false;
		if(isset($p['host'])){//程序中配置数据库连接
			$this->config = $p;
			return true;
		}
		
		if($is_slave && $this->sconfig['host']){//选择slave数据库并且配置了slave数据库
			$this->config = $this->sconfig;
		}else{
			$this->config = $this->mconfig;
		}
	}
	function query($sql,$affect_num=false){//affect_num:是否返回影响行数
		if(!$this->dblink){//只有执行sql的时候才有数据库链接
			$this->dblink = mysql_connect($this->config['host'],$this->config['username'],$this->config['password']) or die('连接失败:' . mysql_error());
			mysql_select_db($this->config['dbname'],$this->dblink) or die('连接失败:'.mysql_error());
			mysql_query("set names utf8",$this->dblink);
		}
		$res = mysql_query($sql,$this->dblink);
		if($affect_num){
			return $res?mysql_affected_rows($this->dblink):0;
		}
		return $res;
	}
	function getOne($sql){//获取单个字段数据
		$query = $this->query($sql);
		$data = mysql_fetch_array($query,MYSQL_NUM);
		return $data[0];
	}
	function getRow($sql){	//取出一条数据
		$query = $this->query($sql);
		$data = mysql_fetch_array($query,MYSQL_ASSOC);
		return $data?$data:array();
	}
	function getRows($sql){		//取出多条数据
		$query = $this->query($sql);
		$data = array();
		while($row = mysql_fetch_array($query,MYSQL_ASSOC)){
			$data[] = $row;
		}
		return $data;
	}
	function insert($table, $data, $return = false,$debug=false) {//插入数据,debug为真返回sql
		if(!$table) {
			return false;
		}
		$fields = array();
		$values = array();
		foreach ($data as $field => $value){
			$fields[] = '`'.$field.'`';
			$values[] = "'".addslashes($value)."'";
		}
		if(empty($fields) || empty($values)) {
			return false;
		}
		$sql = 'INSERT INTO `'.$table.'` 
				('.join(',',$fields).') 
				VALUES ('.join(',',$values).')';
		if($debug){
			return $sql;
		}
		$query = $this->query($sql);
		return $return ? mysql_insert_id() : $query;
	}

	function insert2($table, $data, $return = false,$debug=false) {//插入数据,debug为真返回sql
		if(!$table) {
			return false;
		}
		$fields = array();
		$values = array();
		foreach ($data as $field => $value){
			$fields[] = '`'.$field.'`';
			$values[] = "'".addslashes($value)."'";
		}
		if(empty($fields) || empty($values)) {
			return false;
		}
		$sql = 'INSERT IGNORE INTO `'.$table.'` 
				('.join(',',$fields).') 
				VALUES ('.join(',',$values).')';
		if($debug){
			return $sql;
		}
		$query = $this->query($sql);
		return $return ? mysql_insert_id() : $query;
	}
	function update($table, $condition, $data, $limit = 1,$debug=false) {//更新数据
		if(!$table) {
			return false;
		}
		$set = array();
		foreach ($data as $field => $value) {
			$set[] = '`'.$field.'`='."'".addslashes($value)."'";
		}
		if(empty($set)) {
			return false;
		}
		$sql = 'UPDATE `'.$table.'` 
				SET '.join(',',$set).' 
				WHERE '.$condition.' '.
				($limit ? 'LIMIT '.$limit : '');
		if($debug){
			return $sql;
		}
		return $this->query($sql);
	}
    /*
	*获取常规分页代码
	@sql，（可以传取总数的sql，count(*) as total，也可以直接传总数）
	@page，当前是第几页
	@limit，每页显示多少条数据
	@param，页面本身所带的其他参数
	*/
    function getPage($sql,$page,$limit,$param=null){
        if(is_numeric($sql)){
            $total = $sql;
        }else if($sql){
            $total = $this->getOne($sql);
        }else{
            return '';
        }
        if($total <= $limit){
            return '';
        }

        $total_page = ceil($total/$limit);
        $start_page = $page>3?$page-3:1;
        $end_page = $page+5<$total_page?($page+5):$total_page;

        $html = "<nav><ul class=\"pagination\"><li><a href=\"?page=1{$param}\">首页</a></li>";
        for($pg=$start_page;$pg<=$end_page;$pg++){
            if($page==$pg){
                $html.="<li class=\"active\"><a href=\"#\">{$pg}</a></li>";
            }else{
                $html.="<li><a href=\"?page={$pg}{$param}\">{$pg}</a></li>";
            }
        }
        $npage = $page+1;
        if($npage<=$total_page){
            $html .= "<li><a href=\"?page={$npage}{$param}\">下一页</a></li>";
        }

        $html .= '</ul></nav>';
        return $html;
    }
	/*
	*获取常规分页代码
	@sql，（可以传取总数的sql，count(*) as total，也可以直接传总数）
	@page，当前是第几页
	@limit，每页显示多少条数据
	@param，页面本身所带的其他参数
	*/
	function getPage2($sql,$page,$limit,$param=null){
		if(is_numeric($sql)){
			$total = $sql;
		}else if($sql){
			$total = $this->getOne($sql);
		}else{
			return '';
		}
		if($total <= $limit){
			return '';	
		}
		
		$total_page = ceil($total/$limit);
		$start_page = $page>3?$page-3:1;
		$end_page = $page+5<$total_page?($page+5):$total_page;
		
		$html = "<div class=\"pagination\"><ul><li> <a href=\"?page=1{$param}\" target=\"_self\">首页</a></li>";
		for($pg=$start_page;$pg<=$end_page;$pg++){
			if($page==$pg){
				$html.=" <li><span class=\"cur\">{$pg}</span></li>";
			}else{
				$html.="<li><a href=\"?page={$pg}{$param}\" target=\"_self\">{$pg}</a></li> ";
			}
		}
		$npage = $page+1;
		if($npage<=$total_page){
			$html .= "<li><a href=\"?page={$npage}{$param}\" target=\"_self\">下一页</a></li>";
		}
		$html .="<li><a href=\"?page={$total_page}{$param}\" target=\"_self\">末页</a></li>";
		$html .= '<li></li></ul></div>';
		return $html;
	}

    /*
     *bootstrap
     *获取ajax切换用的分页
     @sql，（可以传取总数的sql，count(*) as total，也可以直接传总数）
     @page，当前是第几页
     @limit，每页显示多少条数据
     @jsfun，ajax分页时请求的js函数。例如：getPost(1,3,0,page)，用{page}替换需要放页码的地方即可
     */
    function getAjaxPage($sql,$page,$limit,$jsfun){
        if(is_numeric($sql)){
            $total = $sql;
        }else if($sql){
            $total = $this->getOne($sql);
        }
        
        if($total <= $limit){
            return '';  
        }
        $total_page = ceil($total/$limit);
        $start_page = $page>3?$page-3:1;
        $end_page = $page+5<$total_page?($page+5):$total_page;
        
        $html = '<nav><ul class="pagination"><li><a href="javascript:void(null);" onclick="'.str_replace('page',1,$jsfun).';">首页</a></li>';
        for($pg=$start_page;$pg<=$end_page;$pg++){
            if($page == $pg){
                $html .= '<li class="active"><a>'.$pg.'</a></li>';
            }else{
                $html .= '<li><a href="javascript:void(null);" onclick="'.str_replace('page',$pg,$jsfun).';">'.$pg.'</a></li>';
            }
        }
        $npage = $page+1;
        if($npage <= $total_page){
            $html .= '<li><a href="javascript:void(null);" onclick="'.str_replace('page',$npage,$jsfun).';">下一页</a></li>';
        }
        //$html .= '<a href="javascript:void(null);" onclick="'.str_replace('page',$total_page,$jsfun).';">末页</a> ';
        $html .= '</ul></nav>';
        return $html;
    }   
	/*
	 *获取ajax切换用的分页
	 @sql，（可以传取总数的sql，count(*) as total，也可以直接传总数）
	 @page，当前是第几页
	 @limit，每页显示多少条数据
	 @jsfun，ajax分页时请求的js函数。例如：getPost(1,3,0,page)，用{page}替换需要放页码的地方即可
	 */
	function getAjaxPage2($sql,$page,$limit,$jsfun){
		if(is_numeric($sql)){
			$total = $sql;
		}else if($sql){
			$total = $this->getOne($sql);
		}

		if($total <= $limit){
			return '';	
		}
		$total_page = ceil($total/$limit);
		$start_page = $page>3?$page-3:1;
		$end_page = $page+5<$total_page?($page+5):$total_page;
		
		$html = '<div class="page clearfix"><a href="javascript:void(null);" onclick="'.str_replace('page',1,$jsfun).';">首页</a>';
		for($pg=$start_page;$pg<=$end_page;$pg++){
			if($page == $pg){
				$html .= '<span class="cur">'.$pg.'</span>';
			}else{
				$html .= ' <a href="javascript:void(null);" onclick="'.str_replace('page',$pg,$jsfun).';">'.$pg.'</a> ';
			}
		}
		$npage = $page+1;
		if($npage <= $total_page){
			$html .= '<a href="javascript:void(null);" onclick="'.str_replace('page',$npage,$jsfun).';">下一页</a> ';
		}
		//$html .= '<a href="javascript:void(null);" onclick="'.str_replace('page',$total_page,$jsfun).';">末页</a> ';
		$html .= '</div>';
		return $html;
	}	
	/*
	*获取rewrite过后的分页代码
	@sql，（可以传取总数的sql，count(*) as total，也可以直接传总数）
	@page，当前是第几页
	@limit，每页显示多少条数据
	@rewrite_rule，rewrite规则，例如list-1-{page}.html，其他的就跟当前页面的链接一样，用{page}替换需要放页码的地方即可
	*/
	function getRewritePage($sql,$page,$limit,$rewrite_rule){
		if(is_numeric($sql)){//求总数
			$total = $sql;
		}else if($sql){
			$total = $this->getOne($sql);
		}else{
			return '';
		}
		if($total <= $limit){
			return '';	
		}
		
		$total_page = ceil($total/$limit);
		$start_page = $page>3?$page-3:1;
		$end_page = $page+5<$total_page?($page+5):$total_page;
		
		$html = '<div class="page clearfix"> <a href="'.str_replace('{page}',1,$rewrite_rule).'" target="_self">首页</a>';
		for($pg=$start_page;$pg<=$end_page;$pg++){
			if($page==$pg){
				$html .= ' <span class="cur">'.$pg.'</span> ';
			}else{
				$html .= ' <a href="'.str_replace('{page}',$pg,$rewrite_rule).'" target="_self">'.$pg.'</a> ';
			}
		}
		$npage = $page+1;
		if($npage <= $total_page){
			$html .= '<a href="'.str_replace('{page}',$npage,$rewrite_rule).'" target="_self">下一页</a> ';
		}
		$html .= '</div>';
		return $html;
	}
}

