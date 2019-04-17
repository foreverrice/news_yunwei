<?php
	$homeLunBoData = unserialize(file_get_contents(dirname(__FILE__).'/homeLunBoData.cache'));
?>
<style type="text/css">
.fleft{
	position:relative;
}
.fleft .slides{
	width:275px;
	height:374px;
	overflow:hidden;
	position:relative;
}
.fleft .slides .slide-pic li{
	float:left;
	_display:inline;
	width:275px;
}
.fleft .slide-li {
    bottom: 8px;
    cursor: pointer;
    position:absolute;
    height: 17px;
    text-align: center;
    width: 175px;
    margin-left:80px;
    z-index:100;
}
.fleft .fi_btn {
    cursor: pointer;
    display: inline-block;
    height: 48px;
    overflow: hidden;
    position: absolute;
    top: 140px;
    width: 36px;
    z-index:1;
}
.fleft .l {
    left: 0;
}
.fleft .r {
    right: 0;
}
.fleft .l_view{
    background: url("/images/icon_left.png") no-repeat 0 0;
    _background: url("/images/icon_left_8bit.png") no-repeat 0 0;
}
.fleft .bg_view{
    display: block;
    height: 48px;
    width: 36px;
}
.fleft .r_view {
    background: url("/images/icon_right.png") no-repeat 0 0;
    _background: url("/images/icon_right_8bit.png") no-repeat 0 0;
}
.fleft a {
    color: #515151;
}
.fleft .slide-pic li{
	position:relative;
	height:374px;
	overflow:hidden;
}
.fleft .slide-pic li .bgtext{
	height:58px;
	width:275px;
	background-color:#000;
	-moz-opacity:.65;
	opacity:.65;
	filter:alpha(opacity=65);
	z-index:1;
	position:absolute;
	left:0;
	bottom:0;
}
.fleft .slide-pic li .title{
	width:275px;
	text-align:center;
	font-size:18px;
	color:#fff;
	position:absolute;
	left:0;
	bottom:0;
	height:50px;
	z-index:10;
}
.fleft .slide-pic li .title a{
	color:#fff;	
	white-space:nowrap;
}
.slide-li li{
    float:left;
    _display:inline;
    background: url("/images/icon_noton.png") no-repeat 0 0;
    _background: url("/images/icon_noton_8bit.png") no-repeat 0 0;
    cursor: pointer;
    font-size: 0;
    height: 17px;
    margin: 0 3px;
    overflow: hidden;
    width: 17px;
}
.slide-li li.cur {
    background: url("/images/icon_on.png") no-repeat 0 0;
    _background: url("/images/icon_on_8bit.png") no-repeat 0 0;
    font-size: 0;
    line-height: 500px;
}
.op li{
    float:left;
    _display:inline;
    background: url("/images/icon_noton.png") no-repeat  0 0;
    _background: url("/images/icon_noton_8bit.png") no-repeat 0 0;
    cursor: pointer;
    font-size: 0;
    height: 17px;
    margin: 0 3px;
    overflow: hidden;
    width: 17px;
}
.op li.cur {
    background: url("/images/icon_on.png") no-repeat 0 0;
    _background: url("/images/icon_on_8bit.png") no-repeat 0 0;
    font-size: 0;
    line-height: 500px;
}
</style>
<div class="l fi_btn">
	<a href="javascript:void(0);"  class="l_view bg_view" target="_self"></a>
</div>
<div class="slides">
	<ul class="slide-pic center_view" width="10000px;right:275px;position:relative;">
		<?php for($i=0;$i<$homeLunBoData['num'];$i++){?>
			<?php if($i==0){?>
			<li class="cur" style="display:list-item;">
                                    <a href="<?php echo $homeLunBoData['links'][$i];?>" target="_blank" style="white-space:nowrap;"><img width="275" height="374" alt="<?php echo $homeLunBoData['texts'][$i];?>" src="<?php echo $homeLunBoData['imgs'][$i];?>"></a>
                                    <div class="bgtext"></div>
                                   <div class="title"><a href="<?php echo $homeLunBoData['links'][$i];?>"><?php echo $homeLunBoData['texts'][$i];?></a></div>
                        </li>
			<?php }else{ ?>
			<li class="cur" style="display:none;">
                                    <a href="<?php echo $homeLunBoData['links'][$i];?>" target="_blank" style="white-space:nowrap;"><img width="275" height="374" alt="<?php echo $homeLunBoData['texts'][$i];?>" src="<?php echo $homeLunBoData['imgs'][$i];?>"></a>
                                    <div class="bgtext"></div>
                                   <div class="title"><a href="<?php echo $homeLunBoData['links'][$i];?>"><?php echo $homeLunBoData['texts'][$i];?></a></div>
                        </li>
			<?php }?>
		<?php }?>
	</ul>
	<ul class="slide-li op">
                                <li class="cur"></li>
                                <li class=""></li>
                                <li class=""></li>
                                <li class=""></li>
                                <li class=""></li>
                            </ul>
                            <ul class="slide-txt slide-li">
                                <li class="cur"></li>
                                <li class=""></li>
                                <li class=""></li>
                                <li class=""></li>
                                <li class=""></li>
                            </ul>
	
</div>
<div class="r fi_btn">
	<a href="javascript:void(0);"  class="r_view bg_view" target="_self"></a>
</div>
<script type="text/javascript" src="/js/slide.js"></script>

