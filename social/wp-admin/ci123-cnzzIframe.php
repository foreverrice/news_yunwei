<?php
require_once('./admin.php');
//require_once('./admin-header.php');
?>
<form name="form" action="http://new.cnzz.com/user/login.php" method="post">
	<input name="username" type="hidden" value="" />
	<input name="password" type="hidden" value="" />
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
//include('./admin-footer.php');
