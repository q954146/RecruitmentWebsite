<!DOCTYPE HTML><head>
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
    <br>
    <br>
    <div id="container">

        <div class="content_mid">
            <dl class="c_section c_section_mid">
                <dt>
                <h2><em></em>填写公司信息</h2>
                </dt>
                <dd>
                    <div class="c_text">目标明确、前途光明的产品是吸引求职者的制胜法宝哦！</div>
                    <img width="668" height="56" class="c_steps" alt="第四步" src="/style/images/step4.png">
                    <div id="formWrap">
                        <form method="post" action="/register/company/product" id="productForm0">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <div id="productDiv0">
                                <div class="formWrapper">
                                    <h3>产品海报</h3>
                                    <br>
                                    <input type="file" id="Img_0" name="Img_0" accept="image/png,image/jpg,image/jpeg,image/gif" onclick="check_img0()">
                                    <br><br>
                                    <img src="" id="proImg_0" width="240" height="120" style="display: none">
                                    <input type="hidden" value="" name="image_0" id="proPicture_0">
                                    <h3>产品名称</h3>
                                    <input type="text" placeholder="请输入产品名称" name="name_0" id="proName0">
                                    <h3>产品地址</h3>
                                    <input type="text" placeholder="请输入产品主页URL或产品下载地址" name="link_0" id="proAddress0">
                                    <h3>产品简介</h3>
                                    <textarea placeholder="请简短描述该产品定位、产品特色、用户群体等" maxlength="1000" name="desc_0" id="proProfile0"></textarea>
                                </div>
                            </div>
                            <div class="clear" style="width: 100%;margin-top:30px;border-bottom: 1px solid silver"></div>
                        </form>
                    </div>

                    <a id="addMember" class="add_member" href="javascript:void(0)"><i></i>继续添加公司产品</a>
                    <input type="submit" value="保存，下一步" id="step4Submit" class="btn_big fr">
                </dd>
            </dl>
        </div>

        <script src="/style/js/step4.min.js" type="text/javascript"></script>

        <div class="clear"></div>

        <a rel="nofollow" title="回到顶部" id="backtop" style="display: inline;"></a>
    </div><!-- end #container -->
</div><!-- end #body -->
@include('headerAndFooter.footer')
<script src="/style/js/core.min.js" type="text/javascript"></script>

<script src="/style/js/popup.min.js" type="text/javascript"></script>
<!-- 弹上传文件框 -->


