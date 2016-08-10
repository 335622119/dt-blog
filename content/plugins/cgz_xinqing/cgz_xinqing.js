var moodzt = "0";
var http_request = false;
function makeRequest(url, functionName, httpType, sendData) {
	http_request = false;
	if (!httpType) httpType = "GET";

	if (window.XMLHttpRequest) {
		http_request = new XMLHttpRequest();
		if (http_request.overrideMimeType) {
			http_request.overrideMimeType('text/plain');
		}
	} else if (window.ActiveXObject) {
		try {
			http_request = new ActiveXObject("Msxml2.XMLHTTP");
		} catch (e) {
			try {
				http_request = new ActiveXObject("Microsoft.XMLHTTP");
			} catch (e) {}
		}
	}
	if (!http_request) {
		alert('Cannot send an XMLHTTP request');
		return false;
	}
	var changefunc="http_request.onreadystatechange = "+functionName;
	eval (changefunc);
	http_request.open(httpType, url, true);
	http_request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	http_request.send(sendData);
}
function vote() {
  var elements = new Array();

  for (var i = 0; i < arguments.length; i++) {
    var element = arguments[i];
    if (typeof element == 'string')
      element = document.getElementById(element);

    if (arguments.length == 1)
      return element;

    elements.push(element);
  }
  return elements;
}
function SetCookie(name,value)
{
    var Seconds = 86400; 
    var exp  = new Date();    
    exp.setTime(exp.getTime() + Seconds*1000);
    document.cookie = name + "="+ escape (value) + ";expires=" + exp.toGMTString();
}
function getCookie(name)  
{
    var arr = document.cookie.match(new RegExp("(^| )"+name+"=([^;]*)(;|$)"));
     if(arr != null) return unescape(arr[2]); return null;
}
function delCookie(name)
{
    var exp = new Date();
    exp.setTime(exp.getTime() - 1);
    var cval=getCookie(name);
    if(cval!=null) document.cookie= name + "="+cval+";expires="+exp.toGMTString();
}
 function remood()
{
	url = ""+pluginpath+"cgz_xinqing_action.php?action=show&id="+infoid+"&m=" + Math.random();
	makeRequest(url,'return_review1','GET','');	
}
function get_mood(mood_id)
{var cookie = getCookie(infoid);

	if(moodzt == "1" || cookie== (infoid)) 
	{
		alert("亲,你已经诉说过您的读后感了！");
	}
	else {
		SetCookie (infoid, (infoid));
		url = ""+pluginpath+"cgz_xinqing_action.php?action=mood&id="+infoid+"&typee="+mood_id+"&m=" + Math.random();
		makeRequest(url,'return_review1','GET','');
		moodzt = "1";
	}
}
function return_review1(ajax)
{	 
	if (http_request.readyState == 4) {
		if (http_request.status == 200) {
			var str_error_num = http_request.responseText;
			if(str_error_num=="error")
			{
				alert("信息不存在！");
			}
			else if(str_error_num==0)
			{
				alert("亲,你已经诉说过您的读后感了！");
			}
			else
			{
				moodinner(str_error_num);
			}
		} else {
			alert('发生了未知错误!!');
		}
	}
}
function moodinner(moodtext)
{
	var color1 = "#666666";
	var color2 = "#EB610E";
	var heightz = "80";	
	var hmax = 0;
	var hmaxpx = 0;
	var heightarr = new Array();
	var moodarr = moodtext.split(",");
	var moodzs = 0;
	for(k=0;k<8;k++) {
		moodarr[k] = parseInt(moodarr[k]);
		moodzs += moodarr[k];
	}
	for(i=0;i<8;i++) {
		heightarr[i]= Math.round(moodarr[i]/moodzs*heightz);
		if(heightarr[i]<1) heightarr[i]=1;
		if(moodarr[i]>hmaxpx) {
		hmaxpx = moodarr[i];
		}
	}
	for(j=0;j<8;j++)
	{
		if(moodarr[j]==hmaxpx && moodarr[j]!=0) {
			vote("moodinfo"+j).innerHTML = "<span style='color: "+color2+";'>"+moodarr[j]+"</span>";
		} else {
			vote("moodinfo"+j).innerHTML = "<span style='color: "+color1+";'>"+moodarr[j]+"</span>";
		}
	}
}
//document.writeln("<div style=\" width:100% \"><span style=\" width:20%  display:block;\"  id=\"moodinfo0\"><\/span><span style=\" width:20%  display:block;\"  id=\"moodinfo1\"><\/span><span style=\" width:20%  display:block;\"  id=\"moodinfo2\"><\/span><span style=\" width:20%  display:block;\"  id=\"moodinfo3\"><\/span><span style=\" width:20%  display:block;\"  id=\"moodinfo4\"><\/span><\/div>");
document.writeln("<div style=\" width:100%;display:block;margin:auto;position:relative;text-align:left;   \"> <ul style=\" text-align:center; list-style:none; width:100% \">");
document.writeln("<li style=\"cursor:pointer; display:inline; position:relative;text-align:center;float:left; width:20%; \" >");
document.writeln("<span style=\"font-size:12px;height:22px;light-height:22px; color:red; \" id=\"moodinfo0\"><\/span><span style=\"font-size:12px;height:22px;light-height:22px; color:red; \">人<\/span>");
document.writeln("<div><a onclick=\"get_mood(\'mood1\')\" ><img src=\""+pluginpath+"images\/0.gif\" \><\/a><\/div>");
document.writeln("<div style=\"font-size:16px;height:26px;light-height:26px;\">掌声<\/div>");
document.writeln("<\/li>");
document.writeln("<li style=\"cursor:pointer; display:inline; position:relative;text-align:center;float:left; width:20%; \" >");
document.writeln("<span style=\"font-size:12px;height:22px;light-height:22px; color:red; \" id=\"moodinfo1\"><\/span><span style=\"font-size:12px;height:22px;light-height:22px; color:red; \">人<\/span>");
document.writeln("<div><a onclick=\"get_mood(\'mood2\')\" ><img src=\""+pluginpath+"images\/1.gif\" \><\/a><\/div>");
document.writeln("<div style=\"font-size:16px;height:26px;light-height:26px;\">感动<\/div>");
document.writeln("<\/li>");
document.writeln("<li style=\"cursor:pointer; display:inline; position:relative;text-align:center;float:left; width:20%; \" >");
document.writeln("<span style=\"font-size:12px;height:22px;light-height:22px; color:red; \" id=\"moodinfo2\"><\/span><span style=\"font-size:12px;height:22px;light-height:22px; color:red; \">人<\/span>");
document.writeln("<div><a onclick=\"get_mood(\'mood3\')\" ><img src=\""+pluginpath+"images\/2.gif\" \><\/a><\/div>");
document.writeln("<div style=\"font-size:16px;height:26px;light-height:26px;\">震惊<\/div>");
document.writeln("<\/li>");
document.writeln("<li style=\"cursor:pointer; display:inline; position:relative;text-align:center;float:left; width:20%; \" >");
document.writeln("<span style=\"font-size:12px;height:22px;light-height:22px; color:red; \" id=\"moodinfo3\"><\/span><span style=\"font-size:12px;height:22px;light-height:22px; color:red; \">人<\/span>");
document.writeln("<div><a onclick=\"get_mood(\'mood4\')\" ><img src=\""+pluginpath+"images\/3.gif\" \><\/a><\/div>");
document.writeln("<div style=\"font-size:16px;height:26px;light-height:26px;\">鄙视<\/div>");
document.writeln("<\/li>");
document.writeln("<li style=\"cursor:pointer; display:inline; position:relative;text-align:center;float:left; width:20%; \" >");
document.writeln("<span style=\"font-size:12px;height:22px;light-height:22px; color:red; \" id=\"moodinfo4\"><\/span><span style=\"font-size:12px;height:22px;light-height:22px; color:red; \">人<\/span>");
document.writeln("<div><a onclick=\"get_mood(\'mood5\')\" ><img src=\""+pluginpath+"images\/4.gif\" \><\/a><\/div>");
document.writeln("<div style=\"font-size:16px;height:26px;light-height:26px;\">无语<\/div>");
document.writeln("<\/li>");
document.writeln("<\/ul><\/div>");
remood();