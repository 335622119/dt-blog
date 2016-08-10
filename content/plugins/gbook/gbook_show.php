<?php
!defined('EMLOG_ROOT') && exit('access deined!');
include EMLOG_ROOT.'/content/plugins/gbook/lib/common.php';

global $CACHE;
$options_cache = $CACHE->readCache('options');
if(!$options_cache['gbook_active']){
	echo 'EMLOG独立留言板功能未激活';
	exit;
}

$Gbook_Option = new Gbook_Option();
$opts = $Gbook_Option -> gbookOptions();

$action = isset($_POST['act'])?htmlspecialchars(trim($_POST['act'])):'';
$page = isset($_GET['page'])?intval($_GET['page']):1;

$blogname = $options_cache['blogname'];
$bloginfo = $options_cache['bloginfo'];
$site_title = $options_cache['blogname'];
$site_title = '在线留言 - '.$blogname;
$site_description = $options_cache['bloginfo'];
$site_key = $options_cache['site_key'];
$log_title = 'GuestBook';
$comments = array('commentStacks'=>array(), 'commentPageUrl'=>'');

$nickname=isset($_POST['nickname'])?addslashes(trim($_POST['nickname'])):'';
$email=isset($_POST['email'])?addslashes(trim($_POST['email'])):'';
$siteurl=isset($_POST['siteurl'])?addslashes(trim($_POST['siteurl'])):'';
$phone=isset($_POST['phone'])?addslashes(trim($_POST['phone'])):'';
$qq=isset($_POST['qq'])?addslashes(trim($_POST['qq'])):'';
$sex=isset($_POST['sex'])?addslashes(trim($_POST['sex'])):'未知';
$content=isset($_POST['content'])?addslashes(trim($_POST['content'])):'';
$verify=isset($_POST['verify'])?strtoupper(addslashes(trim($_POST['verify']))):'';
$uid = isset($_POST['uid'])?intval($_POST['uid']):0;
$pid = isset($_POST['pid'])?intval($_POST['pid']):0;

if( $action == 'addmsg' ){
	$Gbook_Model = new Gbook_Model();
	$Gbook_Model -> addMsg(0,$nickname,$email,$siteurl,$phone,$qq,$sex,$content,$verify,$uid,$pid,'','','');
	exit;
}

emLoadJQuery();
include View::getView('header');
?>
<script type="text/javascript">
function checkMsgForm(){
	<?php
	$mustArr = whatMustDo();
	foreach( $mustArr as $v ):
?>
		var mustDoValue = document.postMsgForm.<?php echo $v;?>.value;
			mustDoValue = mustDoValue.replace(/(^\s*)|(\s*$)/g, "");
		<?php 
		if($v == 'email'){
			?>
			if(!mustDoValue.match(/^[a-z]([a-z0-9]*[-_]?[a-z0-9]+)*@([a-z0-9]*[-_]?[a-z0-9]+)+[\.][a-z]{2,3}([\.][a-z]{2})?$/i)){
				alert('邮箱格式不正确！');
				return false;
			}
			<?php
		}
		if($v == 'siteurl'){
			?>
			if(!mustDoValue.match(/^http:\/\//i) || mustDoValue=='http://'){
				alert('请输入以http://开头的正确网址！');
				return false;
			}
			<?php
		}
		?>
			
		if( mustDoValue == '' ){
			alert('请填写带*号的必填项目！');
			return false;
		}
<?php
	endforeach;
?>
	return true;
}
</script>
<?php
	$log_content = '';
if($opts['formpos']){
	$log_content .= creatGbookForm();
	$log_content .= creatIndexGbookList($page);
}else{
	$log_content .= creatIndexGbookList($page);
	$log_content .= creatGbookForm();
}
include View::getView('page');
 ?>