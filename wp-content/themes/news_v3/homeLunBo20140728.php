<?php
	$homeLunBoData = unserialize(file_get_contents(dirname(__FILE__).'/homeLunBoData.cache'));
?>
<style type="text/css">
.fi07 {
    height: 374px;
    margin: 3px auto 4px;
    width: 275px;
}
.fi07_1 {
    height: 100%;
    position: relative;
    width: 100%;
}
.fi07_1 .fi_ct {
    cursor: pointer;
    height: 100%;
    overflow: hidden;
    position: relative;
}
.fi07_1 .fi_list {
    left: 0;
    position: absolute;
    text-align: left;
    top: 0;
    width: 5000px;
}
.fi07_1 .fi_ovl, .fi07_1 .fi_tt, .fi07_1 .fi_tab {
    bottom: 0;
    left: 0;
    position: absolute;
    width: 100%;
}
.fi07_1 .fi_ovl {
    background: none repeat scroll 0 0 #000;
    bottom: 0;
    height: 58px;
    left: 0;
    width: 100%;
}
.fi07_1 .fi_tt {
    bottom: 30px;
    color: #fff;
    font-size: 18px;
    left: 0;
    line-height: 22px;
    text-align: center;
    width: 100%;
}
.fi07_1 .fi_tab {
    bottom: 8px;
    cursor: default;
    height: 17px;
    text-align: center;
    width: 100%;
}
.fi07_1 .fi_btn {
    cursor: pointer;
    display: inline-block;
    height: 48px;
    overflow: hidden;
    position: absolute;
    top: -180px;
    width: 36px;
}
.fi07_1 .l {
    left: 0;
}
.fi07_1 .r {
    right: 0;
}

.fi07_1 .l a {
    background: url("/images/icon_left.png") repeat scroll 0 0 rgba(0, 0, 0, 0);
}
.fi07_1 .fi_btn a {
    display: block;
    height: 48px;
    width: 36px;
}
.fi07_1 .r a {
    background: url("/images/icon_right.png") repeat scroll 0 0 rgba(0, 0, 0, 0);
}
.fleft a {
    color: #515151;
}
.fi07_1 .fi_tab span {
    background: url("/images/icon_noton.png") repeat scroll 0 0 rgba(0, 0, 0, 0);
    cursor: pointer;
    display: inline-block;
    font-size: 0;
    height: 17px;
    margin: 0 3px;
    overflow: hidden;
    width: 17px;
}
.fi07_1 .fi_tab span.now {
    background: url("/images/icon_on.png") repeat scroll 0 0 rgba(0, 0, 0, 0);
    font-size: 0;
    line-height: 500px;
}
</style>
<div class="fi07" id="MDCFI6WrWbKJJ">
	<div id="MDCFI6WrWbKJJ_1" class="fi07_1">
		<div class="fi_ct">
			<div class="fi_list" style="left: 0px;">
				<?php foreach($homeLunBoData['imgs'] as $v){?>
				<img src="<?php echo $v;?>">
				<?php }?>
			</div>
			<div class="fi_ovl" style="opacity: 0.5; width: 275px;"></div>
			<div class="fi_tt"><?php echo $homeLunBoData['texts'][0];?></div>
		</div>
		<div class="fi_tab">
			<em class="fi_btn l"><a href="#"></a></em>
			<?php foreach($homeLunBoData['links'] as $k=>$v){?>
			<span class="<?php if($k==0){?>now<?php }?>"><a href="<?php echo $v;?>"></a></span>
			<?php }?>
			<em class="fi_btn r"><a href="#"></a></em>
		</div>
	</div>
</div>
<script type="text/javascript" src="/js/mdcfocus.min.js"></script>
<script type="text/javascript">


$("#MDCFI6WrWbKJJ").focusImg({"speed":"<?php echo $homeLunBoData['time']*1000;?>","flag":"fi07","hoverStop":true},[
<?php for($i=0;$i<$homeLunBoData['num'];$i++){?>
{"p":"<?php echo $homeLunBoData['imgs'][$i];?>",
"l":"<?php echo $homeLunBoData['links'][$i];?>",
"t":"<?php echo $homeLunBoData['texts'][$i];?>"},
<?php }?>
]);
</script>
