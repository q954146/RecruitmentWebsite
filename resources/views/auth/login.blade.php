<!DOCTYPE HTML>
<html>
<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>登录-传媒之家-最专业的传媒招聘平台</title>

    <link rel="stylesheet" type="text/css" href="/style/css/style.css"/>

</head>
<body id="login_bg">
<div class="login_wrapper">
    <div class="login_header">
        <a href="/"><img src="/style/images/logo.png" width="285" height="180" alt="传媒之家招聘" /></a>
        <img src="/style/images/cloud_m.png" width="136" height="90"  alt="cloud" />
        <div id="cloud_m"><img src="/style/images/cloud_m.png" width="136" height="90"  alt="cloud" /></div>
    </div>
    <div class="login_box">
        <form id="loginForm" action="/auth/login" method="post">
            {!! csrf_field() !!}
            <input type="text" id="email" name="email" value="" tabindex="1" placeholder="请输入登录邮箱地址" />
            <input type="password" id="password" name="password" tabindex="2" placeholder="请输入密码" />
            <label class="fl" for="remember">
                <input type="checkbox" id="remember" value="" checked="checked" name="remember" /> 记住我
            </label>
            <a href="/password/email" class="fr" target="_blank">忘记密码？</a>

            <input type="submit" id="submitLogin" name="submit" value="登 &nbsp; &nbsp; 录" />

        </form>
        <div class="login_right">
            <div>还没有传媒之家帐号？</div>
            <a  href="/auth/register"  class="registor_now">立即注册</a>
            <br>
            <div>
                @include('errors.formError')
            </div>
        </div>
        <div class="login_box_btm"></div>
    </div>

</div>


</body>
</html>