<!DOCTYPE HTML>
<html>
<head>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
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
                    <div class="c_text">展示强劲的创始团队，让求职者跟随而来吧！</div>
                    <img width="668" height="56" class="c_steps" alt="第三步" src="/style/images/step3.png">
                    <div id="formWrap">
                        <form method="post" action="/register/company/team" id="memberForm_0">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <div id="memberDiv">
                                <div class="formWrapper">
                                    <div class="new_portrait" style="position: absolute;right: -200px;top: 150px">
                                        <div class="portrait_upload" id="portraitNo0">
                                            <span>上传创始人头像</span>
                                        </div>
                                        <input type="file" id="img_0" name="img_0"  accept="image/png,image/jpg,image/jpeg,image/gif" onclick="check_img0()">
                                        <img src="" id="person_img_0" width="120" height="120" style="display: none;position: absolute;top: 120px">
                                        <input type="hidden" value="" name="image_0" id="picture_0">
                                    </div>
                                    <h3>创始人姓名</h3>
                                    <input type="text" placeholder="请输入创始人姓名" name="name_0" id="name_0" class="s_input1 valid">

                                    <h3>当前职位</h3>
                                    <input type="text" placeholder="请输入当前职位，如：创始人兼CEO" name="position_0" id="position_0" class="s_input1 valid">

                                    <h3>新浪微博</h3>
                                    <input type="text" placeholder="请输入创始人新浪微博地址" name="weibo_0" id="weibo_0">

                                    <h3>创始人简介</h3>
                                    <textarea placeholder="请输入该创始人的个人履历等，建议按照时间倒序分条展示" maxlength="1000" name="desc_0" id="desc_0"></textarea>
                                </div>
                            </div>
                            <div class="clear" style="width: 100%;margin-top:30px;border-bottom: 1px solid silver"></div>

                        </form>
                    </div>
                    <a id="addMember" class="add_member" href="javascript:void(0)"><i></i>继续添加创始团队</a>
                    <input type="button" value="保存，下一步" id="step3Submit" class="btn_big fr">
                </dd>
            </dl>
        </div>


        <script src="/style/js/step3.min.js" type="text/javascript"></script>
        <div class="clear"></div>
        <input type="hidden" value="52346c62232045a8ab1d45cb3e0540b7" id="resubmitToken">
        <a rel="nofollow" title="回到顶部" id="backtop" style="display: inline;"></a>
    </div><!-- end #container -->
</div><!-- end #body -->

@include('headerAndFooter.footer')
<script src="/style/js/core.min.js" type="text/javascript"></script>
<script src="/style/js/popup.min.js" type="text/javascript"></script>
<!-- 弹上传文件框 -->
</body>
</html>
