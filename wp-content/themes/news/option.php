<?php
/**
 * 选项组类型
 */
class ClassicOptions {
	/* -- 获取选项组 -- */
	function getOptions() {
		// 在数据库中获取选项组
		$options = get_option('classic_options');
		// 如果数据库中不存在该选项组, 设定这些选项的默认值, 并将它们插入数据库
		if (!is_array($options)) {
			$options['keywords '] = '';
			$options['description'] = '';
			$options['relate'] = '';
			$options['about'] = '';
			$options['tongji'] = '';
			$options['c'] = '';
			$options['iecho'] = '';
			$options['postlistad'] = '';
			$options['postcad'] = '';
			$options['pingad'] = '';
			// TODO: 在这里追加其他选项
			update_option('classic_options', $options);
		}
		// 返回选项组
		return $options;
	}
 
	/* -- 初始化 -- */
	function init() {
		// 如果是 POST 提交数据, 对数据进行限制, 并更新到数据库
		if(isset($_POST['classic_save'])) {
			// 获取选项组, 因为有可能只修改部分选项, 所以先整个拿下来再进行更改
			$options = ClassicOptions::getOptions();
			// 数据限制
			$options['description'] = stripslashes($_POST['description']);
 			$options['keywords'] = stripslashes($_POST['keywords']);
 			$options['about'] = stripslashes($_POST['about']);
 			$options['tongji'] = stripslashes($_POST['tongji']);
			$options['c'] = stripslashes($_POST['c']);
			$options['relate'] = $_POST['relate'];
			$options['iecho'] = $_POST['iecho'];
			//广告数据
			$options['postlistad'] = stripslashes($_POST['postlistad']);//列表
			$options['postcad'] = stripslashes($_POST['postcad']);//文章
			$options['pingad'] = stripslashes($_POST['pingad']);//评论

			
			// TODO: 在这追加其他选项的限制处理
 
			// 更新数据
			update_option('classic_options', $options);
 
		// 否则, 重新获取选项组, 也就是对数据进行初始化
		} else {
			ClassicOptions::getOptions();
		}
 
		// 在后台 Design 页面追加一个标签页, 叫 Current Theme Options
		add_theme_page("主题选项", "主题选项", 'edit_themes', basename(__FILE__), array('ClassicOptions', 'display'));
	}
 
	/* -- 标签页 -- */
	function display() {
		$options = ClassicOptions::getOptions();
?>
<style>
input {width: 30%;}
h3 {height:30px;padding-left:15px;line-height:30px;width:60%}
h4,label,span {margin-left:20px;}
#tab-content .hide {display: none;}
#tab-title {
}
#tab-title span {
border: 1px solid #CDCDCD;
border-left: 0px;
border-top:0px;
margin-left: -2px;
margin-top: -1px;
cursor: pointer;
width: 125px;
float: left;
text-align: center;
}
#tab-title .selected{background:#F0F0F0;}
#e-span{border-right:0 !important;}
</style>
<script>
jQuery(document).ready(function($){
$('.tab-title-2 span').click(function(){
 
	$(this).addClass("selected").siblings().removeClass();
 
	$(".tab-content-2 > ul").hide().eq($('.tab-title-2 span').index(this)).show();
 
});
});

</script>
<form action="#" method="post" enctype="multipart/form-data" name="classic_form" id="classic_form">
	<div class="wrap">
		<h2><?php _e('主题选项', 'classic'); ?></h2>
 
<div id="tab-title" class="tab-title-2">
    <h3>
        <span class="selected">
            博客设置
        </span>
        <span>
            SEO设置
        </span>
        <span id="e-span">
            广告设置
        </span>
    </h3>
</div>
<div id="tab-content" class="tab-content-2">
    <ul>
        <h4>关于</h4>
        <span>支持HTML </span>
        <br/>
        <span> 是否显示? </span>
        <select name="iecho" id="iecho">
<option name="yes" value="yes" <?php $options=get_option('classic_options');if($options['iecho']=="yes" ) : ?>selected="selected"<?php endif;?> > 是</option>
<option name="no" value="no" <?php $options=get_option('classic_options');if($options['iecho']=="no" ) : ?>selected="selected"<?php endif;?> > 否 </option>
        </select>
        <br/>
        <label>
<textarea name="about" cols="50" rows="5" id="about" style="width:50%;font-size:12px;" class="code"><?php echo($options['about']); ?></textarea>
        </label>
<br/>
        <label>
            <span>
                相关文章
            </span>
            <select name="relate" id="relate">
                <option name="cat" value="cat" 
		<?php 
			$options=get_option('classic_options');
			if($options[ 'relate']=="cat" ) :
		?>
                    selected="selected"
                    <?php endif; ?>
                        > 分类相关
                </option>
                <option name="tag" value="tag" 
		<?php 
			$options=get_option('classic_options');
			if($options['relate']=="tag" ) :
		?>
                    selected="selected"
                    <?php endif; ?>
                        > 标签相关
                </option>
            </select>
        </label>
        <h4>
            统计代码
        </h4>
        <span>
            51LA、站长统计等
        </span>
        <br/>
        <label>
<textarea name="tongji" cols="50" rows="5" id="tongji" style="width:50%;font-size:12px;" class="code"><?php echo($options['tongji']); ?></textarea>
            <textarea style="display:none" ; name="c" cols="0" rows="0" id="c" style="width:50%;"
            class="code">
                Theme by
                <a href="http://600duan.com" title="六百段相声网" style="color:#000">
                    600duan
                </a>
                /
            </textarea>
        </label>
    </ul>
    <ul class="hide">
        <h4>
            描述
        </h4>
        <label>
            <textarea name="description" cols="50" rows="5" id="description" style="width:50%;font-size:12px;" class="code"><?php echo($options['description']); ?></textarea>
        </label>
        <h4>
            关键词
        </h4>
        <label>
            <input id="keywords" name="keywords" type="text" value="<?php echo($options['keywords']); ?>" />
            英文半角逗号隔开
        </label>
</ul>
<ul class="hide">
	<h4>文章列表广告</h4>
	<span>最大尺寸650px（宽度）</span>  <br/>
        <label>
	<textarea name="postlistad" cols="50" rows="5" id="postlistad" style="width:50%;font-size:12px;" class="code"><?php echo($options['postlistad']); ?></textarea>
        </label>
	<h4>文章内部广告</h4>
	<span>推荐尺寸(250*250/200*200)</span>  <br/>
        <label>
	<textarea name="postcad" cols="50" rows="5" id="postcad" style="width:50%;font-size:12px;" class="code"><?php echo($options['postcad']); ?></textarea>
        </label>
	<h4>评论上方广告</h4>
	<span>最大尺寸650px（宽度）</span>  <br/>
        <label>
	<textarea name="pingad" cols="50" rows="5" id="pingad" style="width:50%;font-size:12px;" class="code"><?php echo($options['pingad']); ?></textarea>
        </label>
	<h4>边栏广告</h4>
	<span>请在小工具中选择“文本”，可以自定义位置。</span>  <br/>
</ul>
</div>
		

		<!-- TODO: 在这里追加其他选项内容 -->
 
		<!-- 提交按钮 -->
		<p class="submit">
			<input style="width:auto;" type="submit" name="classic_save" value="<?php _e('更新 &raquo;', 'classic'); ?>" />
		</p>
	</div>
 
</form>
 
<?php
	}
}
 
/**
 * 登记初始化方法
 */
add_action('admin_menu', array('ClassicOptions', 'init'));
 
?>