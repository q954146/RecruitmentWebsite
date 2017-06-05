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
        <a href="/"><img src="/style/images/logo.png" width="285" height="180" alt="传媒之家招聘" /></a>
        <img src="/style/images/cloud_m.png" width="136" height="90"  alt="cloud" />
        <div id="cloud_m"><img src="/style/images/cloud_m.png" width="136" height="90"  alt="cloud" /></div>
    </div>
    <input type="hidden" id="resubmitToken" value="" />
    <div class="find_psw">
        <img src="/style/images/psw_step3.png" width="369" height="56" alt="找回密码第三步" />

        <form id="pswConfirmForm" action="/password/reset" method="post">
            {!! csrf_field() !!}

            {{--<input type="email" name="email" id="newpsw"  value="" placeholder="请输入邮箱" />--}}
            {{--<input type="password" name="password" id="newpsw"  value="" placeholder="请输入新密码" />--}}
            {{--<input type="password" name="password_confirmation" id="repeatpsw"  value="" placeholder="请再次输入新密码" />--}}
            {{--<input type="submit" id="pswConfirm" value="确定" />--}}

            <form method="POST" action="/password/reset">
                {!! csrf_field() !!}
                <input type="hidden" name="token" value="{{ $token }}">

                <input type="text" name="email" id="emailpsw" value="" placeholder="请输入邮箱" >

                <input type="password" name="password" placeholder="请输入新密码">

                <input type="password" name="password_confirmation" placeholder="请再次输入新密码">

                <input type="submit" id="pswConfirm" value="确定" />
            </form>
        </form>

    </div>
</div>

</body>
</html>