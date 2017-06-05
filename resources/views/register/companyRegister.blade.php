<!DOCTYPE HTML>
<html>
<head>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type">
    <title>传媒之家-最专业的传媒领域招聘平台</title>
    <link rel="stylesheet" type="text/css" href="/style/css/style.css"/>
    <script type="text/javascript" src="/style/js/jquery.1.10.1.min.js"></script>

</head>
<body>

<div id="body">
    @include('headerAndFooter.headerType1Login')
    <br><br>
    <div id="container">
        <div class="content_mid">
            <!--form-->
            <dl class="c_section c_section_service">
                <dt>
                <h2><em></em>开通招聘服务</h2>
                </dt>
                <dd>
                    <form class="corp_form" id="bindForm" method="post" action="/register/company">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <h3><em class="redstar">*</em>公司名称<span>（请输入与公司营业执照一致的公司全称）</span></h3>
                        <input type="text" value="" placeholder="请输入你的公司名称" name="name" id="name">
                        <h3><em class="redstar">*</em>接收简历邮箱 <span>（该邮箱为公司邮箱，审核通过后不可更改）</span></h3>
                        <input type="text" value="" placeholder="请输入你的公司邮箱作为接收简历邮箱" name="email" id="email">
                        {{--<span id="beError" style="display:none;" class="error"></span>--}}
                        <input type="submit" value="提交" id="bindSubmit">
                    </form>
                    <div class="contactus">
                        <table>
                            <tbody>
                            <tr>
                                <td><br>
                                    如有其它问题，请发送问题到<a href="mailto:1306217787@qq.com">1306217787@qq.com</a>，我们会尽快为你解决。</td>
                            </tr>
                            </tbody></table>
                    </div>
                </dd>
            </dl>
        </div>
    </div>
</div><!-- end #body -->
@include('headerAndFooter.footer')

</body>
</html>