<?php if(!defined('EMLOG_ROOT')) {exit('error!');}?>
<div id="content" class="write">
<form action="./index.php?action=savelog" method="post">
<div class="tips">文章标题</div>
<input type="text" name="title" value="<?php echo $title; ?>" />
<div class="tips">所选分类</div>
<select name="sort" id="sort">
<?php
			$sorts[] = array('sid'=>-1, 'sortname'=>'请选择文章分类--');
			foreach($sorts as $val):
			$flg = $val['sid'] == $sortid ? 'selected' : '';
			?>
			<option value="<?php echo $val['sid']; ?>" <?php echo $flg; ?>><?php echo $val['sortname']; ?></option>
			<?php endforeach; ?>
	</select>
<div class="tips">文章内容(支持html)</div>
<script type="text/javascript">
function getCursortPosition (ctrl) {//获取光标位置函数
		var CaretPos = 0;	// IE Support
		if (document.selection) {
		ctrl.focus ();
			var Sel = document.selection.createRange ();
			Sel.moveStart ('character', -ctrl.value.length);
			CaretPos = Sel.text.length;
		}
		// Firefox support
		else if (ctrl.selectionStart || ctrl.selectionStart == '0')
			CaretPos = ctrl.selectionStart;
		return (CaretPos);
}
function addText(text){
	var srk = document.getElementById("new-content");
	pos = getCursortPosition(srk);
		s = srk.value;
		srk.value = s.substring(0, pos)+text+s.substring(pos);
}
</script>
<div class="addword">
<a onclick='addText("&lt;p&gt;");return false;'>段始</a>

<a onclick='addText("&lt;/p&gt;");return false;'>段终</a>

<a onclick='addText("&lt;br/&gt;");return false;'>换行</a>

<a onclick='addText("&lt;b&gt;&lt;/b&gt;");return false;'>加粗</a>

<a onclick='addText("&lt;em&gt;&lt;/em&gt;");return false;'>斜体</a>

<a onclick='addText("&lt;hr/&gt;");return false;'>横线</a>

<a onclick='addText("&lt;del&gt;&lt;/del&gt;");return false;'>删除线</a>

<a onclick='addText("&lt;li&gt;&lt;/li&gt;");return false;'>编号</a>

<a onclick='addText("&lt;sup&gt;&lt;/sup&gt;");return false;'>上标</a>

<a onclick='addText("&lt;sub&gt;&lt;/sub&gt;");return false;'>下标</a>

<a onclick='addText("&lt;div style=\"text-align:center;\"&gt;&lt/div&gt;");return false;'>居中</a>

<a onclick='addText("&lt;div style=\"text-align:right;\"&gt;&lt/div&gt;");return false;'>居右</a>

<a onclick='addText("&lt;td&gt;&lt;/td&gt;");return false;'>单元格</a>

<a onclick='addText("&lt;a href=\"\" target=\"_blank\" title=\"\"&gt;&lt;/a&gt;");return false;'>链接</a>

<a onclick='addText("&lt;img src=\"\" alt=\"\"/&gt;");return false;'>插图</a>

<a onclick='addText("&lt;span class=\"nickname\"&gt;&lt;/span&gt;");return false;'>昵称</a>

<a onclick='addText("&lt;h3&gt;&lt;/h3&gt;");return false;'>标题3</a>

<a onclick='addText("&lt;h4&gt;&lt;/h4&gt;");return false;'>标题4</a>

<a onclick='addText("&lt;strong&gt;&lt;/strong&gt;");return false;'>强调</a>

<a onclick='addText("&lt;div class=\"quote\"&gt;&lt;/div&gt;");return false;'>引用</a>

</div>

<textarea name="content" class="post-textarea" id="new-content" rows="8"><?php echo $content; ?></textarea><br />
<hr>
<textarea id="code_transform" rows="6"></textarea>
<select id="code_type">
<option value="js">JavaScript</option><option value="html">HTML</option><option value="css">CSS</option><option value="php">PHP</option><option value="pl">Perl</option><option value="py">Python</option><option value="rb">Ruby</option><option value="java">Java</option><option value="vb">ASP/VB</option><option value="cpp">C/C++</option><option value="cs">C#</option><option value="xml">XML</option><option value="bsh">Shell</option><option value="">Other</option>
</select>
<button onclick="htmltransform();return false;">代码高亮</button><button onclick="addText(document.getElementById('code_transform').value);return false;">确认加入</button>
<script type="text/javascript">
 function htmltransform(){
var srcode = document.getElementById('code_transform');
var code_type = document.getElementById('code_type');
var codetype = code_type.options[code_type.selectedIndex].value;
s = srcode.value;
s = s.replace(/</g,"&lt;");
s = s.replace(/>/g,"&gt;");
s = s.replace(/\n/g,"<br/>");
srcode.value = '<pre class="prettyprint lang-'+codetype+' linenums">'+s+'</pre>';
}
</script>
<div class="tips">内容摘要(留空则截取文章)</div>
<textarea name="excerpt" class="excerpt"><?php echo $excerpt; ?></textarea>
<div class="tips">给文章贴标签(两三个即可)</div>
<input type="text" name="tag" value="<?php echo $tagStr; ?>" />
<input type="hidden" name="gid" value=<?php echo $logid; ?> />
<input name="token" id="token" value="<?php echo LoginAuth::genToken(); ?>" type="hidden" />
<input type="hidden" name="author" value=<?php echo $author; ?> />
<input name="date" type="hidden" value="<?php print !empty($date) ? gmdate('Y-m-d H:i:s', $date) : ''; ?>" />
<input type="submit" value="发布文章" />
</form>
</div>
