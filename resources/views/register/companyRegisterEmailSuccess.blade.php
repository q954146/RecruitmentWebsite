<!DOCTYPE HTML>
<html>
<head>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type">
    <title>传媒之家-最专业的传媒领域招聘平台</title>
    <link rel="stylesheet" type="text/css" href="/style/css/style.css"/>
    <link href="/style/css/popup.css" type="text/css" rel="stylesheet">
    <script type="text/javascript" src="/style/js/jquery.1.10.1.min.js"></script>

<body>
<div id="body">
    @include('headerAndFooter.headerType1Login')
    <!-- end #header -->
    <div id="container">
        <br><br>
        <div class="content_mid">
            <!--验证邮箱-->
            <dl class="c_section c_section_service">
                <dt>
                <h2><em></em>开通招聘服务</h2>
                </dt>
                <dd>
                    <div class="open_service_success">
                        <h3>验证邮件已发送至：{{$email}}</h3>
                        <h4>请登录邮箱点击邮件内的链接，验证后即可发布职位</h4>

                    </div>
                    <div class="open_service_success_btm">
                        <h5>没有收到确认邮件，怎么办？</h5>
                        <div class="contacttip">
                            1.邮箱地址填写错误？ <a href="/register/company">重新填写邮箱地址</a> <br>
                            2.看看是否在邮箱的垃圾邮件、广告邮件目录里<br>
                            3.稍等几分钟，若还未收到验证邮件，重新发送验证邮件</a> <br>
                            4.还未收到验证邮件，请联系我们，邮箱：1306217787@qq.com
                        </div>
                        <!-- <span id="tip" style="display:none; float:right; margin:-60px 0 0 -20px;">验证邮件发送成功！</span> -->
                    </div>
                </dd>
            </dl>

            <!------------------------------------- 弹窗lightbox ----------------------------------------->
            <div style="display:none;">
                <!--
                    激活邮箱
                    验证邮件发送成功弹窗
                -->
                <div class="popup" id="resend_success">
                    <p>我们已将激活邮件发送至：<a>jason@admin.com</a>，请点击邮件内的链接完成验证。</p>
                </div><!--/#resend_success-->
            </div>
            <!------------------------------------- end ----------------------------------------->

        </div><!-- end #container -->
    </div><!-- end #body -->
    @include('headerAndFooter.footer')
</div>
</body>
</html>
