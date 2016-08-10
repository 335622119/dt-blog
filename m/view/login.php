<?php if(!defined('EMLOG_ROOT')) {exit('error!');}?>
<div id="content"><div id="loginform">
<form method="post" action="./index.php?action=auth">
<div class="user-info"><span>用户名</span><input type="text" name="user" /></div>
<div class="user-info"><span>密码</span><input type="password" name="pw" /></div>
<?php echo $ckcode; ?>
<br/><input type="submit" value=" 登 录" />
</form>
</div></div>