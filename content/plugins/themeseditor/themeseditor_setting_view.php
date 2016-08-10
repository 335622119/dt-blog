<?php
/**
 * themeseditor_setting.php
 * design by GodSon
 */
!defined('EMLOG_ROOT') && exit('access deined!');
?>
<script type="text/javascript">
	$("#themeseditor").addClass('sidebarsubmenu1');
	setTimeout(hideActived,2600);
</script>
<link rel="stylesheet" href="../content/plugins/themeseditor/CodeMirror/codemirror.css">
<link rel="stylesheet" href="../content/plugins/themeseditor/CodeMirror/theme/<?php echo CODEMIRROR_THEME;?>.css" id="mirrTheme">
<script src="../content/plugins/themeseditor/CodeMirror/codemirror.js"></script>
<script src="../content/plugins/themeseditor/CodeMirror/util.js"></script>

<script src="../content/plugins/themeseditor/CodeMirror/mode.js"></script>

<div style="text-align: center;"><?php if (isset($_GET['setting'])): ?><span class="actived">保存成功</span><?php endif; ?><span class="saveStatus" style="color: red;"></span></div>
<div style="width:100%;float:left;">
	<div style="float:left;"><h3 style="margin: 0;padding:0;">当前编辑 <?php echo $themeName; ?> 主题的文件：<?php echo $themeFileName; ?></h3></div>
	<div style="float:right;">请选择要编辑的主题文件：<select onchange="changeSelectTheme(this)" id="themeName">
				<?php
				foreach ($themeseditor_theme_list as $theme) {
					if ($theme == $themeName) {
						echo "<option selected='selected'>$theme</option>";
					} else {
						echo "<option>$theme</option>";
					}
				}
				?>
			</select><select onchange="changeSelectThemeFile(this)" id="themeNameFile">
			 <?php
				foreach ($themeseditor_theme_files as $file) {
					if ($file == $themeFileName) {
						echo "<option selected='selected'>$file</option>";
					} else {
						echo "<option>$file</option>";
					}
				}
				?>
			</select></div>
</div>
<div style="width:830px;padding:5px;border: 1px solid #CAC9C9;-moz-border-radius: 5px;-webkit-border-radius: 5px;float:left;">
		<textarea name="newcontent" id="newcontent" tabindex="1" style="display:none"><?php echo$themeseditor_theme_content; ?></textarea>
</div>

<div>
	<input type="hidden" name="fileP" value="<?php echo$themeseditor_currentFile ?>">
	<input type="button" value="更新文件" onClick="saveFileContent()"/>
	<select onchange="selectTheme()" id="select" style="float: right;">
		<?php
			foreach (explode(",",THEMESEDITOR_EDITOR_THEMES) as $name) {
				if ($name == CODEMIRROR_THEME) {
					echo "<option selected='selected'>$name</option>";
				} else {
					echo "<option>$name</option>";
				}
			}
			?>
	</select>
</div>
<h3>快捷方式</h3>
<div><b>保存更新</b>(Ctrl-S / Cmd-S) &nbsp;&nbsp;<b>全屏编辑</b>(F11) &nbsp;&nbsp;<b>退出全屏</b>(Esc) <br/><b>搜索</b>(Ctrl-F / Cmd-F) &nbsp;&nbsp;<b>查找下一个</b>(Ctrl-G / Cmd-G) &nbsp;&nbsp;<b>查找上一个</b>(Shift-Ctrl-G / Shift-Cmd-G) <br/><b>替换</b>(Shift-Ctrl-F / Cmd-Option-F) &nbsp;&nbsp;<b>替换所有</b>(Shift-Ctrl-R / Shift-Cmd-Option-F)</div>
<hr/>
<div>作者：<a href="http://www.btboys.com">GodSon</a> <a href="http://bbs.btboys.com">Easyui 中文社区</a></div>
<style type="text/css">
  .CodeMirror-fullscreen {
	display: block;
	position: absolute;
	top: 0; left: 0;
	width: 100%;
	z-index: 9999;
  }
</style>
 <script>
 function isFullScreen(cm) {
  return /\bCodeMirror-fullscreen\b/.test(cm.getWrapperElement().className);
}
function winHeight() {
  return window.innerHeight || (document.documentElement || document.body).clientHeight;
}
function setFullScreen(cm, full) {
  var wrap = cm.getWrapperElement();
  if (full) {
	wrap.style.width = "100%";
	$(wrap).addClass("CodeMirror-fullscreen")
		   .height(winHeight() + "px");
	document.documentElement.style.overflow = "hidden";
  } else {
	$(wrap).removeClass("CodeMirror-fullscreen");
	wrap.style.height = "";
	document.documentElement.style.overflow = "";
  }
  cm.refresh();
}
CodeMirror.on(window, "resize", function() {
  var showing = document.body.getElementsByClassName("CodeMirror-fullscreen")[0];
  if (!showing) return;
  showing.CodeMirror.getWrapperElement().style.height = winHeight() + "px";
});
var CodeMirrorEditor = CodeMirror.fromTextArea(document.getElementById("newcontent"), {
	lineNumbers: true,
	matchBrackets: true,
	mode: "<?php echo $mode;?>",
	indentUnit: 4,
	indentWithTabs: true,
	enterMode: "keep",
	tabMode: "shift",
	theme:"<?php echo CODEMIRROR_THEME;?>",
	extraKeys: {
		"F11": function(cm) {
		  setFullScreen(cm, !isFullScreen(cm));
		},
		"Esc": function(cm) {
		  if (isFullScreen(cm)) setFullScreen(cm, false);
		},
		"Ctrl-S":saveFileContent
	}
});
CodeMirrorEditor.setSize(null,500);
var style = $("<style></style>").appendTo("head");
function selectTheme() {
	$(".saveStatus").text("主题加载ing....").fadeIn();
	var theme = $("#select").val();
	$.ajax({
		url:"../content/plugins/themeseditor/CodeMirror/theme/"+theme+".css",
		dataType:"text",
		success:function(data){
			style.html(data);
			CodeMirrorEditor.setOption("theme", theme);
			$(".saveStatus").text("主题加载成功").delay(2000).fadeOut();
		}
	});
	$.post("../content/plugins/themeseditor/themeseditor_controler.php",{action:"saveEditorThemes",name:theme});
}

function changeSelectTheme(target){
	window.location.replace('./plugin.php?plugin=themeseditor&themeName='+$(target).val());
}
function changeSelectThemeFile(target){
	window.location.replace('./plugin.php?plugin=themeseditor&themeName='+$("#themeName").val()+"&themeFileName="+$(target).val());
}
var saving = false;
function saveFileContent(){
	if(!saving){
		saving = true;
		$(".saveStatus").text("更新ing....").fadeIn();
		$.post("../content/plugins/themeseditor/themeseditor_controler.php",{action:"save",themeName:$("#themeName").val(),fileName:$("#themeNameFile").val(),content:CodeMirrorEditor.getValue()},function(rsp){
			if(rsp.status){
				$(".saveStatus").text("更新成功！").delay(2000).fadeOut();
			}else{
				$(".saveStatus").text("更新失败！").delay(2000).fadeOut();
			}
			saving = false;
		},"JSON").error(function(){saving = false;});
	}
}
</script>