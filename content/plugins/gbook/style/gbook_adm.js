

$(function(){
	if($("#gbook").length){
		gbookTab($("#gbookBoard"));

		$(" #lyList ul li.item:even ").css("background-color","#f5f5f5");
		$(" .lySetting ").each(function(){
			$(this).find("tr:even").css("background-color","#f5f5f5");
		})

		$(" #lyList ul li.item" ).hover(function(){
			$(this).find(".operate").show();
		},function(){
			$(this).find(".operate").hide();
		});
	}
	
})

function insertEmData(id,token){
	if(!confirm("确定导入？"))
		return false;
	$.ajax({
		type: "POST",
		dataType: "html",
		url: './plugin.php?plugin=gbook',
		data: 'act=insertEmData&emlypage='+id+'&token='+token,              
		success: function (data) {
			alert(data);
		}
	});
}

function subOption(obj){
	data = obj.serialize();
	$.ajax({
		type: "POST",
		dataType: "html",
		url: './plugin.php?plugin=gbook',
		data: data,              
		success: function (data) {
			alert('更新成功！');
		}
	});
}

function gbookTab(obj){
	//alert('ok');
	var tabT = obj.find("#gbooktabT");
	var tabC = obj.find("#gbooktabC");
	tabT.find(".tabT").each(function(index){
		var tab = $(this);
		tab.click(function(){
			tab.siblings().removeClass("current");
			tab.toggleClass("current");
			tabC.find(".tabC").hide();
			tabC.find(".tabC:eq("+index+")").show();
		});
	});
}

function subPass(id,token){
	var sId = id;
	var token = token;
	$.ajax({
		type: "POST",
		dataType: "html",
		url: './plugin.php?plugin=gbook',
		data: "act=pass&token="+token+"&id="+sId,            
		success: function (data) {
			$("span.unpass"+sId).remove();
		}
	});
}
function delMsg(id,token){
	if(!confirm("确定删除？")){
		return false;
	}
	var sId = id;
	var token = token;
	$.ajax({
		type: "POST",
		dataType: "html",
		url: './plugin.php?plugin=gbook',
		data: "act=del&token="+token+"&id="+sId,              
		success: function (data) {
			$("li#msgItem"+sId).fadeOut();
		}
	});
}

function operateAct(act){
	if (getChecked('ids') == false) {
		alert('请选择要操作的项目');
		return;
	}
	var ids = new Array();
	var index = 0;
	$("input.ids").each(function(){
		if($(this).attr("checked") == 'checked'){
			ids[index] = $(this).val();
			index = index+1;
		}
	});
	var token = $("input[name=token]").val();

	data = {};
	data['act'] = act;
	data['token'] = token;
	data['ids'] = ids;

	if(act == 'delall'){
		if(!confirm("确定删除？")){
			return false;
		}
	}
	$.ajax({
		type: "POST",
		dataType: "html",
		url: './plugin.php?plugin=gbook',
		data: data,              
		success: function (data) {
			//alert(data);
			window.location.href= './plugin.php?plugin=gbook';
		}
	});
}