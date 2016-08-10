function MailChange(i,obj)
{
var url= new Array();
var username= new Array();
var pwd= new Array();
id=i;
url[0]=" ";
username[0]="";
pwd[0]="";
//@163.com
url[1]="http://reg.163.com/CheckUser.jsp";
username[1]="username";
pwd[1]="password";
//@126.com
url[2]="http://entry.126.com/cgi/login";
username[2]="user";
pwd[2]="pass";
//@yeah.net
url[3]="http://entry.yeah.net/cgi/login";
username[3]="user";
pwd[3]="pass";
//@vip.163.com
url[4]="http://vip.163.com/logon.m";
username[4]="username";
pwd[4]="password";
//@sina.com
url[5]="http://mail.sina.com.cn/cgi-bin/login.cgi";
username[5]="u";
pwd[5]="psw";
//@vip.sina.com
url[6]="http://vip.sina.com.cn/cgi-bin/login.cgi";
username[6]="user";
pwd[6]="pass";
//@sohu.com
url[7]="http://passport.sohu.com/login.jsp";
username[7]="UserName";
pwd[7]="Password";
//@yahoo.com.cn
url[8]="https://edit.bjs.yahoo.com/config/login";
username[8]="login";
pwd[8]="passwd";
//@yahoo.cn
url[9]="https://edit.bjs.yahoo.com/config/login";
username[9]="login";
pwd[9]="passwd";
//@Gmail.com
url[10]="https://www.google.com/accounts/ServiceLoginAuth";
username[10]="Email";
pwd[10]="Passwd";
//@tom.com
url[11]="http://bjweb.mail.tom.com/cgi/163/login_pro.cgi";
username[11]="user";
pwd[11]="pass";
//@hotmail.com
url[12]="https://login.passport.com/ppsecure/post.srf?id=2&svc=mail&cbid=24325&msppjph=1&tw=0&fs=1&fsa=1&fsat=1296000&lc=2052&_lang=CN&bk=1136886915";
username[12]="login";
pwd[12]="passwd";
//@msn.com
url[13]="https://login.passport.com/ppsecure/post.srf?id=2&svc=mail&cbid=24325&msppjph=1&tw=0&fs=1&fsa=1&fsat=1296000&lc=2052&_lang=CN&bk=1136886915";
username[13]="login";
pwd[13]="passwd";
//163.net
url[14]="http://bjweb.mail.tom.com/cgi/163/login_pro.cgi";
username[14]="user";
pwd[14]="pass";
//21cn.com
url[15]="http://passport.21cn.com/maillogin.jsp";
username[15]="UserName";
pwd[15]="passwd";
//2008.sina.com
url[16]="http://mail.2008.sina.com.cn/cgi-bin/login.php";
username[16]="u";
pwd[16]="psw";
//baidu
url[17]="http://passport.baidu.com/?login";
username[17]="username";
pwd[17]="password";
//ChinaRen
url[18]="http://passport.sohu.com/login.jsp";
username[18]="loginid";
pwd[18]="passwd";
//校内网
url[19]="http://login.xiaonei.com/Login.do";
username[19]="email";
pwd[19]="password";
//51.com
url[20]="http://passport.51.com/login.5p";
username[20]="passport_51_user";
pwd[20]="passport_51_password";

url[21]="http://passport.sohu.com/login.jsp";
username[21]="UserName";
pwd[21]="Password";

url[22]="http://passport.sohu.com/login.jsp";
username[22]="username";
pwd[22]="passwd";

document.getElementById("Musername"+obj).name=username[id];
document.getElementById("Mpwd"+obj).name=pwd[id];
document.getElementById("mail_login"+obj).action=url[id]; 
}

function MailVerify(obj)
{
	
    if(document.getElementById("maillist"+obj).value==0)
    {
	 alert("请选择你要登陆的邮箱");
	 return false;
	}	

    if (document.getElementById("Musername"+obj).value==""||document.getElementById("Mpwd"+obj).value=="")
   {
	alert("用户名或密码不能为空");
	return false;
	}
	if(document.getElementById("maillist"+obj).value==12) {
		document.getElementById("Musername"+obj).value=document.getElementById("Musername"+obj).value+'@hotmail.com';
     }
     if (document.getElementById("maillist"+obj).value==9)
     {
       document.getElementById("Musername"+obj).value=document.getElementById("Musername"+obj).value+'@yahoo.cn';
     }
	 if(document.getElementById("maillist"+obj).value==22)
    {
	   userName = document.getElementById("Musername"+obj).value;
	   strusername = document.getElementById("Musername"+obj).value+"@sogou.com";	
	   document.getElementById("loginid").value = strusername;
	   document.getElementById("eru").value = "http://mail.sogou.com/2gmail/login.jsp?username="+userName;
	}	
     if(document.getElementById("maillist"+obj).value==21)
    {
frm = document.getElementById("mail_login"+obj);
frm.elements['appid'].value = "1000";
frm.elements['ru'].value = "http://login.mail.sohu.com/servlet/LoginServlet";
frm.elements['eru'].value = "http://login.mail.sohu.com/login.jsp";
frm.elements['ct'].value = "1173080990";
frm.elements['sg'].value = "5082635c77272088ae7241ccdf7cf062";
frm.elements['id'].value = document.getElementById("Musername"+obj).value;
frm.elements['username'].value = document.getElementById("Musername"+obj).value;
frm.elements['password'].value =document.getElementById("Mpwd"+obj).value;
frm.elements['m'].value = document.getElementById("Musername"+obj).value;
frm.elements['mpass'].value = document.getElementById("Mpwd"+obj).value;
frm.elements['loginid'].value = document.getElementById("Musername"+obj).value+"@sohu.com";
frm.elements['passwd'].value = document.getElementById("Mpwd"+obj).value;
frm.elements['fl'].value = "1";
frm.elements['vr'].value = "1|1";
frm.action="http://passport.sohu.com/login.jsp";
}
    setTimeout("ResetPwd()",1000);
    return true;
}	

function ResetPwd()
{
	document.getElementById("Mpwd").value="";
	 
}
