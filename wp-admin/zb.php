<?php
	require_once('./admin.php');
	require_once('./admin-header.php');
	setcookie('UC_CNZZTOKEN','7641a3a40bfc6e6129654ee2a389945d',time()+86400,'/','cnzz.com');
?>
<div style="width: 990px; margin: 0 auto;">
	登陆规则改变，请手动输入用户名：ci123news@163.com 密码：fuyuan1904
	<iframe border="0" vspace="0" hspace="0" marginwidth="0" marginheight="0" framespacing="0" frameborder="0" scrolling="no" width="990" height="1500" src="http://tongji.cnzz.com/main.php?c=site&a=show&from=login"></iframe>
</div>
<form name="form" action="https://i.cnzz.com/main.php?c=useropt&a=login&ajax=module=check" method="post">
        <input name="cnzzUserName" type="hidden" value="" />
        <input name="cnzzPwd" type="hidden" value="" />
        <input name="list" type="hidden" value="" />
</form>
<script type="text/javascript">
pubPost();
function pubPost()
{
        var f = document.form;
        f.username.value = "ci123news@163.com";
        f.password.value = "fuyuan1904";
        f.list.value = "1";
        f.submit();
}
</script>
<?php
	include('./admin-footer.php');
