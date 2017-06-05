<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>注册-传媒之家-最专业的传媒招聘平台</title>
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
        <form id="loginForm" method="post" action="/auth/register">
            {!! csrf_field() !!}
            <ul class="register_radio clearfix">
                <li>
                    找工作
                    <input type="radio" value="0" name="type" />
                </li>
                <li>
                    招人
                    <input type="radio" value="1" name="type" />
                </li>
            </ul>
            <input type="text" id="name" name="name" tabindex="1" placeholder="请输入用户名" />

            <input type="text" id="email" name="email" tabindex="1" placeholder="请输入常用邮箱地址" />

            <input type="password" id="password" name="password" tabindex="2" placeholder="请输入密码" />
            <input type="password" id="password_confirmation" name="password_confirmation" tabindex="2" placeholder="请再输入一次密码" />

            <input type="submit" id="submitLogin" name="submit" value="注 &nbsp; &nbsp; 册" />

        </form>

        <div class="login_right">
            <div>已有传媒之家帐号</div>
            <a  href="/auth/login"  class="registor_now">直接登录</a>
            <br>
            <div>
                @include('errors.formError')
            </div>
        </div>
        <div class="login_box_btm"></div>

    </div>

    <script type="text/javascript" src="/style/js/jquery.1.10.1.min.js"></script>
    <script>
        $(function(){
            $(":radio").click(function(){
                $(".register_radio li em").remove();
                $(this).parent().append('<em></em>');
            });
        });
//    </script>

</div>
</body>
</html>