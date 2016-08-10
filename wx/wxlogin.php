<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="content-type" content="text/html;charset=utf-8">
    </head>
    <body>
        <span id="login_container"></span>
        <script src="http://res.wx.qq.com/connect/zh_CN/htmledition/js/wxLogin.js"></script>
        <script>
            var obj = new WxLogin({
              id: "login_container",
              appid: "wxd9c15541d540e3b4",
              scope: "snsapi_userinfo",
              redirect_uri: encodeURIComponent("http://" + window.location.host + "/wxLogin.php"),
              state: Math.ceil(Math.random()*1000),
              style: "black",
              href: ""});
        </script>
    </body>
</html>