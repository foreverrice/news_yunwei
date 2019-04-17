<div id="navb">
	<div class="navb_block">
		<ul>
			<li class="lg"><a title="育儿商城" href="http://diy.ci123.com/">育儿商城</a></li>
			<li class="s">|</li>
			<li><a title="幼儿园" href="http://ping.ci123.com/">幼儿园</a></li>
			<li class="s">|</li>
			<li><a title="城市伙伴" href="http://city.ci123.com/happycity/">城市伙伴</a></li>
			<li class="s">|</li>
			<li><a title="儿童城" href="http://cblog.ci123.com/">儿童城</a></li>
			<!--<li class="s">|</li>
			<li><a title="汉博网" href="http://hanbo.ci123.com/">汉博网</a></li>-->
			<li class="s">|</li>
			<li><a title="育儿资讯" href="http://news.ci123.com/">育儿资讯</a></li>
			<li class="s">|</li>
			<li><a title="公益频道" href="http://jiguang.ci123.com/">公益频道</a></li>
			<li class="s">|</li>
			<li><a title="小脚印" href="http://foot.ci123.com/">小脚印</a></li>
		</ul>
		<dl class="link">
			<dd class="ci on"><a href="http://www.ci123.com/">育儿网</a></dd>
			<dd class="gou"><a href="http://shop.ci123.com/" target="_blank">妈妈购</a></dd>
			<dd class="app"><a href="http://m.ci123.com/apps/preg.html" target="_blank">手机应用</a></dd>
		</dl>
		<script type="text/javascript">
		$(".link .gou a").click(function(e){
			e.preventDefault();
			window.open($(this).attr('href') + '?lps=1369117390.19.43.2');
		});
		</script>
		</dl>
		<div class="login">
		
			<div class="tnservice" id="islogin" style="display:none;">
				<div id="topservice" class="more off">
					<div><a class="nav-sv2" href="javascript:void(0);" target="_self"><img src="http://i.ci123.com/avatar/no.png" id="lg_avatar" width="20" height="20" />&nbsp;个人中心<s></s></a></div>
					<div class="topuser">
						<dl>
							<dd><a href="http://user.ci123.com/account/EditUserInfo/detail" target="_blank">我的资料</a></dd>
							<dd><a href="http://user.ci123.com/" target="_blank">用户中心</a></dd>
							<dd><a href="http://user.ci123.com/inbox.php" target="_blank">查看邮件</a></dd>
							<dd><a href="http://user.ci123.com/account/message/" target="_blank">系统消息</a></dd>
							<dd><a href="http://user.ci123.com/coin/" target="_blank">我的积分</a></dd>
							<dd><a href="http://user.ci123.com/logout.php?back_url=<?=bloginfo('url')?>">退出登录</a></dd>
						</dl>
					</div>
				</div>
			</div>
			
			<div class="loginface" id="notlogin"><a onclick="needlogin();" href="javascript:void(0);">登录</a> <a href="http://user.ci123.com/account/NewAccount/?back_url=http://news.ci123.com/" target="_blank">注册</a></div>
			
			<script type="text/javascript">
			jQuery("#topservice").hover(
				function(){
					jQuery(this).removeClass("off");
					jQuery(this).addClass("on");
				},function(){
					jQuery(this).removeClass("on");
					jQuery(this).addClass("off");
				}
			);
			</script>
			<script type="text/javascript">
			function initLogin() {
				var ciuser = getUserInfo();
				if (ciuser != null && ciuser.user_id > 0) {
					//document.getElementById("lg_nickname").innerHTML = ciuser.nickname;
					document.getElementById('lg_avatar').src = ciuser.avatar;
					document.getElementById('notlogin').style.display = 'none';
					document.getElementById('islogin').style.display = '';
		}	
	}
	$(document).ready(function() {
		initLogin();
	});
	</script>
		</div><!--/login-->
	</div>
</div>
