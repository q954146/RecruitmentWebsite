<!DOCTYPE HTML><head>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type">
    <title>传媒之家-最专业的传媒领域招聘平台</title>
    <!-- 下拉选择框 -->

    <link href="/style/css/style.css" type="text/css" rel="stylesheet">
    <link href="/style/css/external.min.css" type="text/css" rel="stylesheet"><!-- 上传文件选择框装饰 -->
    <link href="/style/css/popup.css" type="text/css" rel="stylesheet"><!-- 上传文件选择框内部装饰 -->
    <script type="text/javascript" src="/style/js/jquery.1.10.1.min.js"></script>
    <script src="/style/js/jquery.lib.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="/style/js/ajaxfileupload.js"></script>
    <script src="/style/js/additional-methods.js" type="text/javascript"></script>
</head>

<body>
<div id="body">
@include('headerAndFooter.headerType1Login')
    <div id="container">

        <div class="content_mid">
            <dl class="c_section c_section_mid">
                <dt>
                <h2><em></em>填写公司信息</h2>
                </dt>
                <dd>
                    <div class="c_text">背景深、规模大、发展快、氛围好…用优势吸引求职者吧！</div>
                    <img width="668" height="56" class="c_steps" alt="第五步" src="/style/images/step5.png">
                    <!-- action="http://www.lagou.com/c/saveProfile.json" -->
                    <form method="post" action="/register/company/desc" id="infoForm">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <h3>公司介绍</h3>
                        <textarea placeholder="请分段详细描述公司简介、企业文化等" name="desc" id="companyProfile"></textarea>
                        <div class="word_count">你还可以输入 <span>1000</span> 字</div>
                        <div class="clear"></div>
                        <input type="button" id="step5Submit" value="保存，完成" class="btn_big fr">
                    </form>
                </dd>
            </dl>
        </div>
        <script src="/style/js/step5.min.js" type="text/javascript"></script>


        <div class="clear"></div>
        <input type="hidden" value="52346c62232045a8ab1d45cb3e0540b7" id="resubmitToken">
        <a rel="nofollow" title="回到顶部" id="backtop" style="display: inline;"></a>
    </div><!-- end #container -->
</div><!-- end #body -->
@include('headerAndFooter.footer')
<script src="style/js/core.min.js" type="text/javascript"></script>

<script src="style/js/popup.min.js" type="text/javascript"></script>
<!-- 弹上传文件框 -->


