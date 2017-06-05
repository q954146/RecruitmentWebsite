
<!DOCTYPE HTML>
<html>
<head>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type">
    <title>传媒之家-最专业的传媒领域招聘平台</title>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
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
                <dd id="step2Form">
                    <div class="c_text">简短明了的标签信息让求职者更加方便检索，更快找到你们！</div>
                    <img width="668" height="56" class="c_steps" alt="第二步" src="/style/images/step2.png">
                    <h3>已添加标签</h3>
                    <ul class="reset" id="labels">
                    </ul>

                    <div id="box_labels">
                        <dl>
                            <dt>薪酬激励</dt>
                            <dd>
                                @foreach($tags1 as $tag1)
                                <ul class="reset">
                                    <li>{{$tag1['name']}}</li>
                                </ul>
                                @endforeach
                            </dd>
                        </dl>
                        <dl>
                            <dt>员工福利</dt>
                            <dd>
                                @foreach($tags2 as $tag2)
                                    <ul class="reset">
                                        <li>{{$tag2['name']}}</li>
                                    </ul>
                                @endforeach
                            </dd>
                        </dl>
                        <dl>
                            <dt>员工关怀</dt>
                            <dd>
                                @foreach($tags3 as $tag3)
                                    <ul class="reset">
                                        <li>{{$tag3['name']}}</li>
                                    </ul>
                                @endforeach
                            </dd>
                        </dl>
                        <dl>
                            <dt>其他</dt>
                            <dd>
                                @foreach($tags4 as $tag4)
                                    <ul class="reset">
                                        <li>{{$tag4['name']}}</li>
                                    </ul>
                                @endforeach
                            </dd>
                        </dl>
                    </div>
                    <input type="button" value="保存，下一步" id="step2Submit" class="btn_big fr">
                </dd>
            </dl>
        </div>

        <script src="/style/js/step2.min.js" type="text/javascript"></script>
        <div class="clear"></div>
        <input type="hidden" value="" id="resubmitToken">
        <a rel="nofollow" title="回到顶部" id="backtop" style="display: none;"></a>
    </div><!-- end #container -->
</div><!-- end #body -->
<div id="footer">
    <div class="wrapper">
        <a href="h/about.html" target="_blank" rel="nofollow">联系我们</a>
        <a href="h/af/zhaopin.html" target="_blank">传媒公司导航</a>
        <a href="http://e.weibo.com/chuanmeizhijia" target="_blank" rel="nofollow">传媒之家微博</a>
    </div>
</div>

<script src="/style/js/core.min.js" type="text/javascript"></script>

<script src="/style/js/popup.min.js" type="text/javascript"></script>
<!-- 弹上传文件框 -->
</body>
</html>


