<!DOCTYPE HTML>
<html>
<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>找回密码-传媒之家-最专业的传媒招聘平台</title>

    <link rel="Shortcut Icon" href="http://www.lagou.com/images/favicon.ico">
    <link rel="stylesheet" type="text/css" href="/style/css/style.css"/>

    <script src="/style/js/jquery.1.10.1.min.js" type="text/javascript"></script>

    <script type="text/javascript" src="/style/js/jquery.lib.min.js"></script>
    <script type="text/javascript" src="/style/js/analytics.js"></script>

</head>
<body id="login_bg">
<div class="login_wrapper">
    <div class="login_header">
        <a href="h/"><img src="/style/images/logo.png" width="285" height="180" alt="传媒之家招聘" /></a>
        <img src="/style/images/cloud_m.png" width="136" height="90"  alt="cloud" />
        <div id="cloud_m"><img src="/style/images/cloud_m.png" width="136" height="90"  alt="cloud" /></div>
    </div>
    <input type="hidden" id="resubmitToken" value="" />
    <div class="find_psw">
        <div class="emailLogin_wrapper">
            <img src="/style/images/psw_step2.png" width="369" height="56" alt="找回密码第二步" />
            <div class="email_text1">密码重置邮件已发至您的邮箱</div>
            <div class="email_text2">{{$email}}</div>
            <div class="email_text3">请在1小时内登录你的邮箱接收邮件，链接激活后可重置密码</div>
            <input type="button" id="emailLogin" value="登录邮箱查看" />
        </div>
    </div>
</div>

</body>
</html>