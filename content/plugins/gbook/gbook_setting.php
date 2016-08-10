<?php
!defined('EMLOG_ROOT') && exit('access deined!');
include EMLOG_ROOT.'/content/plugins/gbook/lib/common.php';

$action = isset($_POST['act'])?htmlspecialchars(trim($_POST['act'])):'';
$page = isset($_GET['page'])?intval($_GET['page']):1;
$msgId = isset($_POST['id'])?intval($_POST['id']):0;
$msgIds = isset($_POST['ids'])?$_POST['ids']:'';
$emlypage = isset($_POST['emlypage'])?intval($_POST['emlypage']):0;

$Gbook_Model = new Gbook_Model();
$Gbook_Option = new Gbook_Option();


if($action == 'pass'){
	LoginAuth::checkToken();
	$Gbook_Model -> passOneMsg($msgId);
	exit;
}elseif($action == 'del'){
	LoginAuth::checkToken();
	$Gbook_Model -> delOneMsg($msgId);
	exit;
}elseif($action == 'passall'){
	LoginAuth::checkToken();
	if($msgIds){
		foreach($msgIds as $k => $v){
			$Gbook_Model -> passOneMsg($v);
		}
	}
}elseif($action == 'delall'){
	LoginAuth::checkToken();
	if($msgIds){
		foreach($msgIds as $k => $v){
			$Gbook_Model -> delOneMsg($v);
		}
	}
}elseif($action == 'updOpts'){
	LoginAuth::checkToken();
	$data = $_POST;
	unset($data['act']);
	unset($data['token']);
	$Gbook_Option -> updateGbookOpts($data);
	exit;
}elseif($action == 'insertEmData'){
	LoginAuth::checkToken();
	$Gbook_Model -> insertEmData($emlypage);
	exit;
}

function plugin_setting_view(){
	GLOBAL $page;
	$Gbook_Option = new Gbook_Option();
	$opts = $Gbook_Option -> gbookOptions();
	$emPages = getEmPages();
?>

<script langauge="javascript" type="text/javascript">
	$(function(){
		$(".selectall").toggle(function () {
			$(".ids[disabled!=disabled]").attr("checked", "checked");},function () {$(".ids").removeAttr("checked");
		});

	})
</script>

<div id="gbookBoard">
	<div class="board">
		<div id="gbooktabT">
			<div class="tabT current">留言列表</div>
			<div class="tabT">功能设置</div>
			<div class="tabT">表单设置</div>
			<div class="tabT">显示设置</div>
			<div class="tabX"><a href="<?php echo BLOG_URL;?>?plugin=gbook" target="_blank">访问留言板</a></div>
			<div class="clear"></div>
		</div>
		<div id="gbooktabC">
			<div class="tabC" style="display:block;">
				<?php creatAdminGbookList($page);?>
			</div>
			<div class="tabC">
				<form name="options1" action="./plugin.php?plugin=gbook" method="post">
					<input type="hidden" value="updOpts" name="act">
					<input name="token" id="token" value="<?php echo LoginAuth::genToken(); ?>" type="hidden" />
					<table class="lySetting" cellspacing="0" >
						<tr>
							<td>留言间隔时间设置</td>
							<td>
								<input type="text" name="duration" value="<?php echo $opts['duration'];?>" size="5" /> 秒
							</td>
							<td class="tip"></td>
						</tr>
						<tr>
							<td>登录设置</td>
							<td>
								<input type="radio" name="need_login" value="1" <?php if($opts['need_login'] == 1) echo 'checked="checked"';?> />需要登录
								<input type="radio" name="need_login" value="0" <?php if($opts['need_login'] == 0) echo 'checked="checked"';?> >无需登录
							</td>
							<td class="tip">
								用户是否需要登录后才能留言
							</td>
						</tr>
						<tr>
							<td>审核设置</td>
							<td>
								<input type="radio" name="need_check" value="1" <?php if($opts['need_check'] == 1) echo 'checked="checked"';?> />需要审核
								<input type="radio" name="need_check" value="0" <?php if($opts['need_check'] == 0) echo 'checked="checked"';?> />无需审核
							</td>
							<td class="tip">
								未审核的留言不会在前台留言板页面显示
							</td>
						</tr>
						<tr>
							<td>数据导入</td>
							<td>
								<select name="emlypage">
									<?php print_r($emPages);?>
									<option value="0">选择目标页面</option>
									<?php 
									foreach ($emPages as $key => $value) {
										?>
										<option value="<?php echo $value;?>" <?php if($value == $opts['emlypage']) echo 'selected="selected"';?> ><?php echo $key;?></option>
										<?php
									}
									?>
								</select>
								<input type="button" value="点击导入" onclick="insertEmData(document.options1.emlypage.value,'<?php echo LoginAuth::genToken(); ?>')" />
							</td>
							<td class="tip">
								导入EMLOG本身独立页面留言数据
							</td>
						</tr>
						<tr>
							<td>插件作者</td>
							<td colspan="2"><a href="http://www.myemlog.com/" target="_blank">秦时明月</a>（QQ：87419525）</td>
						</tr>
						<tr>
							<td colspan="3">
								<input type="button" value="提交保存" class="sub" onclick="subOption($('form[name=options1]'))"  /><span class="operateTip"></span>
							</td>
						</tr>
					</table>
				</form>
			</div>
			<div class="tabC">
				<form name="options2" action="./plugin.php?plugin=gbook" method="post">
					<input type="hidden" name="act" value="updOpts" />
					<input name="token" id="token" value="<?php echo LoginAuth::genToken(); ?>" type="hidden" />
					<table class="lySetting" cellspacing="0" >
						<tr>
							<td>留言表单开关</td>
							<td>
								<input type="radio" name="show_form" value="1" <?php if($opts['show_form'] == 1) echo 'checked="checked"';?> />开启留言
								<input type="radio" name="show_form" value="0" <?php if($opts['show_form'] == 0) echo 'checked="checked"';?> />关闭留言
							</td>
							<td class="tip"></td>
						</tr>
						<tr>
							<td>验证码设置</td>
							<td>
								<input type="radio" name="show_verify" value="1" <?php if($opts['show_verify'] == 1) echo 'checked="checked"';?> />显示
								<input type="radio" name="show_verify" value="0" <?php if($opts['show_verify'] == 0) echo 'checked="checked"';?> />不显示
							</td>
							<td class="tip"></td>
						</tr>
						<tr>
							<td>昵称设置</td>
							<td>
								<input type="radio" name="is_nickname" value="1" <?php if($opts['is_nickname'] == 1) echo 'checked="checked"';?> />必填
								<input type="radio" name="is_nickname" value="2" <?php if($opts['is_nickname'] == 2) echo 'checked="checked"';?> />不必填
								<input type="radio" name="is_nickname" value="0" <?php if($opts['is_nickname'] == 0) echo 'checked="checked"';?> />不显示
							</td>
							<td class="tip"></td>
						</tr>
						<tr>
							<td>邮箱设置</td>
							<td>
								<input type="radio" name="is_email" value="1" <?php if($opts['is_email'] == 1) echo 'checked="checked"';?> />必填
								<input type="radio" name="is_email" value="2" <?php if($opts['is_email'] == 2) echo 'checked="checked"';?> />不必填
								<input type="radio" name="is_email" value="0" <?php if($opts['is_email'] == 0) echo 'checked="checked"';?> />不显示
							</td>
							<td class="tip"></td>
						</tr>
						<tr>
							<td>网址设置</td>
							<td>
								<input type="radio" name="is_siteurl" value="1" <?php if($opts['is_siteurl'] == 1) echo 'checked="checked"';?> />必填
								<input type="radio" name="is_siteurl" value="2" <?php if($opts['is_siteurl'] == 2) echo 'checked="checked"';?> />不必填
								<input type="radio" name="is_siteurl" value="0" <?php if($opts['is_siteurl'] == 0) echo 'checked="checked"';?> />不显示
							</td>
							<td class="tip"></td>
						</tr>
						<tr>
							<td>
								电话设置
							</td>
							<td>
								<input type="radio" name="is_phone" value="1" <?php if($opts['is_phone'] == 1) echo 'checked="checked"';?> />必填
								<input type="radio" name="is_phone" value="2" <?php if($opts['is_phone'] == 2) echo 'checked="checked"';?> />不必填
								<input type="radio" name="is_phone" value="0" <?php if($opts['is_phone'] == 0) echo 'checked="checked"';?> />不显示
							</td>
							<td class="tip"></td>
						</tr>
						<tr>
							<td>
								QQ设置
							</td>
							<td>
								<input type="radio" name="is_qq" value="1" <?php if($opts['is_qq'] == 1) echo 'checked="checked"';?> />必填
								<input type="radio" name="is_qq" value="2" <?php if($opts['is_qq'] == 2) echo 'checked="checked"';?> />不必填
								<input type="radio" name="is_qq" value="0" <?php if($opts['is_qq'] == 0) echo 'checked="checked"';?> />不显示
							</td>
							<td class="tip"></td>
						</tr>
						<tr>
							<td>
								性别设置
							</td>
							<td>
								<input type="radio" name="is_sex" value="1" <?php if($opts['is_sex'] == 1) echo 'checked="checked"';?> />必填
								<input type="radio" name="is_sex" value="2" <?php if($opts['is_sex'] == 2) echo 'checked="checked"';?> />不必填
								<input type="radio" name="is_sex" value="0" <?php if($opts['is_sex'] == 0) echo 'checked="checked"';?> />不显示
							</td>
							<td class="tip"></td>
						</tr>
						<tr>
							<td>
								内容设置
							</td>
							<td>
								<input type="radio" name="is_content" value="1" <?php if($opts['is_content'] == 1) echo 'checked="checked"';?> />必填
								<input type="radio" name="is_content" value="2" <?php if($opts['is_content'] == 2) echo 'checked="checked"';?> />不必填
								<input type="radio" name="is_content" value="0" <?php if($opts['is_content'] == 0) echo 'checked="checked"';?> />不显示
							</td>
							<td class="tip"></td>
						</tr>
						<tr>
							<td colspan="3">
								<input type="button" value="提交保存" class="sub" onclick="subOption($('form[name=options2]'))"  /><span class="operateTip"></span>
							</td>
						</tr>
					</table>
				</form>
			</div>
			<div class="tabC">
				<form name="options3" action="" method="post">
					<input type="hidden" name="act" value="updOpts" />
					<input name="token" id="token" value="<?php echo LoginAuth::genToken(); ?>" type="hidden" />
					<table class="lySetting" cellspacing="0" >
						<tr>
							<td>列表显示设置</td>
							<td>
								<input type="radio" name="show_front" value="1" <?php if($opts['show_front'] == 1) echo 'checked=checked';?> />显示列表
								<input type="radio" name="show_front" value="0" <?php if($opts['show_front'] == 0) echo 'checked=checked';?> />关闭列表
							</td>
							<td class="tip">
								是否在留言板页面显示留言列表
							</td>
						</tr>
						<tr>
							<td>表单位置</td>
							<td>
								<input type="radio" name="formpos" value="1" <?php if($opts['formpos'] == 1) echo 'checked=checked';?> />表单在前
								<input type="radio" name="formpos" value="0" <?php if($opts['formpos'] == 0) echo 'checked=checked';?> />表单在后
							</td>
							<td class="tip"></td>
						</tr>
						<tr>
							<td>前台分页设置</td>
							<td>
								<input type="text" name="indexPerPageNum" value="<?php echo $opts['indexPerPageNum'];?>" size="10" /> 条/页
							</td>
							<td class="tip"></td>
						</tr>
						<tr>
							<td>昵称</td>
							<td>
								<input type="radio" name="show_nickname" value="1" <?php if($opts['show_nickname'] == 1) echo 'checked=checked';?> />显示
								<input type="radio" name="show_nickname" value="0" <?php if($opts['show_nickname'] == 0) echo 'checked=checked';?> />不显示
							</td>
							<td class="tip">
								该项目是否显示在留言列表，下同
							</td>
						</tr>
						<tr>
							<td>时间</td>
							<td>
								<input type="radio" name="show_time" value="1" <?php if($opts['show_time'] == 1) echo 'checked=checked';?> />显示
								<input type="radio" name="show_time" value="0" <?php if($opts['show_time'] == 0) echo 'checked=checked';?> />不显示
							</td>
							<td class="tip"></td>
						</tr>
						<tr>
							<td>网址</td>
							<td>
								<input type="radio" name="show_siteurl" value="1" <?php if($opts['show_siteurl'] == 1) echo 'checked=checked';?> />显示
								<input type="radio" name="show_siteurl" value="0" <?php if($opts['show_siteurl'] == 0) echo 'checked=checked';?> />不显示
							</td>
							<td class="tip"></td>
						</tr>
						<tr>
							<td>性别</td>
							<td>
								<input type="radio" name="show_sex" value="1" <?php if($opts['show_sex'] == 1) echo 'checked=checked';?> />显示
								<input type="radio" name="show_sex" value="0" <?php if($opts['show_sex'] == 0) echo 'checked=checked';?> />不显示
							</td>
							<td class="tip"></td>
						</tr>
						<tr>
							<td>内容</td>
							<td>
								<input type="radio" name="show_content" value="1" <?php if($opts['show_content'] == 1) echo 'checked=checked';?> />显示
								<input type="radio" name="show_content" value="0" <?php if($opts['show_content'] == 0) echo 'checked=checked';?> />不显示
							</td>
							<td class="tip"></td>
						</tr>
						<tr>
							<td colspan="3">
								<input type="button" value="提交保存" class="sub" onclick="subOption($('form[name=options3]'))"  /><span class="operateTip"></span>
							</td>
						</tr>
					</table>
				</form>
			</div>
		</div>

	</div>
</div>
	<?php
}






?>