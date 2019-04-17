<?php
/**
 * @abstract 翻页操作类
 * @final 2011.08.26
 */

class Ci123_Page {
	/**
	 * @abstract 记录总数
	 */
	public $totalNum;
	
	/**
	 * @abstract 每页条数
	 */
	public $pageSize;
	
	/**
	 * @abstract 总页数
	 */
	public $pageNum;
	
	/**
	 * @abstract 当前页码
	 */
	public $page;
	
	/**
	 * @abstract 当前偏移
	 */
	public $offset;
	
	/**
	 * @abstract 翻页标签
	 */
	public $flag;
	
	/**
	 * @abstract 当前链接
	 */
	public $url;
	
	/**
	 * @abstract 左偏移显示量
	 */
	public $preSize;
	
	/**
	 * @abstract 右偏移显示量
	 */
	public $nextSize;
	
	/**
	 * @abstract 模版
	 */
	public $template;
	
	/**
	 * @abstract 分页代码
	 */
	protected $html;
	
	/**
	 * @abstract 根据页码翻页
	 */
	public static function usePage($totalNum, $pageSize, $page = 1, $flag = 'p', $url = null) {
		$config = array(
			'totalNum'	=>	$totalNum,
			'pageSize'	=>	$pageSize,
			'page'	=>	$page,
			'flag'	=>	$flag,
			'url'	=>	$url
		);
		return new Ci123_Page($config);		
	}
	
	/**
	 * @abstract 根据偏移翻页
	 */
	public static function useOffset($totalNum, $pageSize, $offset = 0, $flag = 'offset', $url = null) {
		$config = array(
			'totalNum'	=>	$totalNum,
			'pageSize'	=>	$pageSize,
			'offset'	=>	$offset,
			'flag'	=>	$flag,
			'url'	=>	$url
		);
		return new Ci123_Page($config);		
	}
	
	public function __construct($config = null) {
		$this->init($config);
	}
	
	public function getParam($key) {
		if (isset($this->$key)) {
			return $this->$key;
		}
		return null;
	}
	
	public function setParam($key, $value) {
		$this->$key = $value;
	}
	
	public function init($config = null) {
		// 传递参数
		if (!empty($config) && is_array($config)) {
			foreach ($config as $k => $v) {
				$this->setParam($k, $v);
			}
		}
		// 记录总数
		$this->totalNum = abs(intval($this->totalNum));
		if(empty($this->totalNum)) {
			$this->totalNum = 0;
		}
		// 每页条数
		$this->pageSize = abs(intval($this->pageSize));
		if(empty($this->pageSize)) {
			$this->pageSize = 10;
		}
		// 总页数
		$this->pageNum = ceil($this->totalNum / $this->pageSize);
		// 当前链接
		$this->url = str_replace(array('\\'), '', $this->url);
		if(empty($this->url)) {
			$this->url = $_SERVER['REQUEST_URI'];
		}
		$this->url = preg_replace('/[?|&]'.$this->flag.'=[0-9]+/', '', $this->url);
		// 左偏移
		$this->preSize = 4;
		// 右偏移
		$this->nextSize = 4;
		// 模版
		$this->template = 'default';
		// 当前页码、偏移
		if (isset($this->page)) {
			$this->page = abs(intval($this->page));
			if (empty($this->page) || $this->page < 0) {
				$this->page = 1;
			}
			if ($this->pageNum > 0 && $this->page > $this->pageNum) {
				$this->page = $this->pageNum;
			}
			$this->offset = $this->pageSize * ($this->page - 1);
			if (empty($this->flag)) {
				$this->flag = 'p';
			}
		} elseif (isset($this->offset)) {
			$this->offset = abs(intval($this->offset));
			if (empty($this->offset) || $this->offset < 0) {
				$this->offset = 0;
			}
			if ($this->offset > $this->totalNum - 1) {
				$this->offset = $this->totalNum - 1;
			}
			$this->page = floor($this->offset / $this->pageSize) + 1;
			if (empty($this->flag)) {
				$this->flag = 'offset';
			}
		} else {
			$this->page = 1;
			$this->offset = 0;
			if (empty($this->flag)) {
				$this->flag = 'p';
			}
		}
	}
	
	public function getPage() {
		$html = '';
		if ($this->pageNum > 1) {
			if ($this->page > 1) {
				// 首页
				$html .= '<a href="'.$this->url.'">首页</a>';
				// 上一页
				if ($this->page == 2) {
					$html .= '<a href="'.$this->url.'">上一页</a>';
				} else {
					$html .= '<a href="'.$this->url.'/'.($this->page - 1).'">上一页</a>';
				}
				// 左偏移
				$start = max(1, $this->page - $this->preSize);
				for ($i = $start; $i < $this->page; $i++) {
					if ($i == 1) {
						$html .= '<a href="'.$this->url.'">1</a>';
					} else {
						$html .= '<a href="'.$this->url.'/'.$i.'">'.$i.'</a>';
					}
				}
			}
			$html .= '<span class="on">'.$this->page.'</span>';
			if ($this->page < $this->pageNum) {
				// 右偏移
				$end = min($this->pageNum, $this->page + $this->nextSize);
				for ($i = $this->page + 1; $i <= $end; $i++) {
					$html .= '<a href="'.$this->url.'/'.$i.'">'.$i.'</a>';
				}
				// 下一页
				$html .= '<a href="'.$this->url.'/'.($this->page + 1).'">下一页</a>';
				// 尾页
				$html .= '<a href="'.$this->url.'/'.($this->pageNum).'">尾页</a>';
			}
		}
		$link = false === stripos($this->url, '?') ?  '?' : '&';
		$html = preg_replace("/\/([0-9]+)/", $link.$this->flag.'=$1', $html);
		return $html;
	}
	
	function getInfo() {
		$return .= "<span>共 " . $this->totalNum . " 条,";
		$list_from = ($this->offset + 1 > $this->totalNum) ? $this->totalNum : $this->offset + 1;
		$list_to = ($this->offset + $this->pageSize >= $this->totalNum) ? $this->totalNum : $this->offset + $this->pageSize;
		$return .= "显示: " . $list_from . " - " . $list_to."条</span>";
		return $return;
	}

	function getSelect() {
		$this->url = preg_replace('/\/(\d+)$/', '', $this->url);
		$sel_num = $this->pageNum;
		$return .= "<select name=\"changepage\" onchange=\"javascript:location.href=this.value;\"><option selected> 页面跳转 </option>";
		for ($opt = 0; $opt <= ($sel_num-1); $opt++){
			$num = $opt * $this->pageSize;
			$opt_num = $opt + 1;
			$return .= "<option value=\"{$this->url}/$num\">第" . $opt_num . "页</option>";
		}
		$return .= "</select>";
		return $return;
	}

	// 自定义样式 - Medo - 2012/02/15
	function getInfo_selfDefine() {
		$return .= "<span class='total'>共" . $this->pageNum . "页</span>";
		return $return;
	}
	
	function getBar() {
		$return = $this->getPage()."    ".$this->getInfo_selfDefine();
		return $return;
	}
}
?>