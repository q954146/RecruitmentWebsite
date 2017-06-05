<!DOCTYPE HTML>
<html>
<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>找回密码-传媒之家-最专业的传媒招聘平台</title>
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
        <img src="/style/images/psw_step1.png" width="369" height="56" alt="找回密码第一步" />
        </form>
        <form id="pswForm" action="/password/email" method="post">
            {!! csrf_field() !!}
            <input type="text" name="email" id="email" tabindex="1" value="{{ old('email')}}" placeholder="请输入注册时使用的邮箱地址" />
            <input type="submit" id="submitLogin" value="找回密码" />
        </form>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $('#pswForm input[type="text"]').focus(function(){
            $(this).siblings('.error').hide();
        });
        //验证表单

        $("#pswForm").validate({
            rules: {
                email: {
                    required: true,
                    email: true
                }
            },
            messages: {
                email: {
                    required: "请输入注册时使用的邮箱地址",
                    email: "请输入有效的邮箱地址，如：vivi@lagou.com"
                }
            },
            submitHandler:function(form){
                $(form).find(":submit").attr("disabled", true);
                form.submit();
            }
        });
    });
</script>
</body>
</html>