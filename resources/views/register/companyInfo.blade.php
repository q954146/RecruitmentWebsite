<!DOCTYPE HTML>
<html>
<head>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type">
\    <title>传媒之家-最专业的传媒领域招聘平台</title>
    <script type="text/javascript">
        var ctx = "http://123.207.137.43";
    </script>
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

        <div style="" id="stepTip">
            <a></a>
            <img width="803" height="59" src="/style/images/index1.jpg">
        </div>

        <div class="content_mid">
            <dl class="c_section c_section_mid">
                <dt>
                <h2><em></em>填写公司信息</h2>
                </dt>
                <dd>
                    <form id="stepForm">
                        <div class="c_text_1">基本信息为必填项，是求职者加速了解公司的窗口，认真填写吧！</div>
                        <img width="668" height="56" class="c_steps" alt="第一步" src="/style/images/step1.png">

                        <h3>公司全称 <span>{{$name}}</span></h3>
                        <h3>公司联系电话</h3> <!--非必填-->
                        <input type="tel" placeholder="请输入公司联系电话" value="" name="tel" id="tel" class="valid">

                        <h3>公司简称</h3> <!--非必填-->
                        <input type="text" placeholder="请输入公司简称" value="" name="name" id="name" class="valid">

                        <h3>公司LOGO</h3>
                        <input type="file" name="file0" id="logo" accept="image/png,image/jpg,image/jpeg,image/gif" onclick="check_img()" /><br><br>
                        <img src="" id="logo_img" width="380" height="220" style="display: none">

                        <h3>公司网址</h3>
                        <input type="text" placeholder="请输入公司网址" value="" name="website" id="website">

                        <h3>所在城市</h3>
                        <input type="text" placeholder="请输入工作城市，如：北京" name="city" id="city">

                        <h3>行业领域</h3>
                        <div>
                            <input type="hidden" value="" name="select_industry_hidden" id="select_industry_hidden">
                            <input type="button" value="请选择行业领域" name="select_industry" id="select_industry" class="select">
                            <div class="dn" id="box_industry" style="display: none;">
                                <ul class="reset">

                                    @foreach($tradeInfos as $tradeInfo)
                                        <li>{{$tradeInfo}}</li>
                                    @endforeach

                                </ul>
                            </div>
                        </div>

                        <h3>公司规模</h3>
                        <div>
                            <input type="hidden" value="" name="select_scale_hidden" id="select_scale_hidden">
                            <input type="button" value="请选择公司规模" id="select_scale" class="select">
                            <div class="dn" id="box_scale" style="display: none;">
                                <ul class="reset">
                                    <li>少于15人</li>
                                    <li>15-50人</li>
                                    <li>50-150人</li>
                                    <li>150-500人</li>
                                    <li>500-2000人</li>
                                    <li>2000人以上</li>
                                </ul>
                            </div>
                        </div>

                        <h3>发展阶段</h3>
                        <div>
                            <input type="hidden" id="s_radio_hidden" name="s_radio_hidden" value="">
                            <ul class="s_radio clearfix s_radio_ex">
                                <li>未融资</li>
                                <li>天使轮</li>
                                <li>A轮</li>
                                <li>B轮</li>
                                <li>C轮</li>
                                <li>D轮及以上</li>
                                <li>上市公司</li>
                            </ul>
                        </div>

                        <h3>一句话介绍</h3>
                        <input type="text" placeholder="一句话概括公司亮点，如公司愿景、领导团队等，限50字" maxlength="50" name="temptation" id="temptation">
                        <span style="display:none;" class="error" id="beError"></span>
                        <input type="hidden" id="companyName" name="companyName" value="{{$name}}">
                        <input type="submit" value="保存，下一步" id="stepBtn" class="btn_big fr">

                    </form>
                </dd>
            </dl>
        </div>

        <script src="/style/js/step1.min.js" type="text/javascript"></script>
        <!--<script>-->
        <!--var avatar = {};-->
        <!--avatar.uploadComplate = function( data ){-->
        <!--var result = eval('('+ data +')');-->
        <!--if(result.success){-->
        <!--jQuery('#logoShow img').attr("src",ctx+ '/'+result.content);-->
        <!--jQuery.colorbox.close();-->
        <!--jQuery('#logoNo').hide();-->
        <!--jQuery('#logoShow').show();-->
        <!--}-->
        <!--};-->
        <!--</script>-->
        <div class="clear"></div>
        <input type="hidden" value="13ae35fedd9e45cdb66fb712318d7369" id="resubmitToken">
        <a rel="nofollow" title="回到顶部" id="backtop" style="display: none;"></a>
    </div><!-- end #container -->
</div><!-- end #body -->
@include('headerAndFooter.footer')

<script src="/style/js/core.min.js" type="text/javascript"></script>

<script src="/style/js/popup.min.js" type="text/javascript"></script>
<!-- 弹上传文件框 -->


</body>
</html>