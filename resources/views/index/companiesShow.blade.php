<!DOCTYPE HTML>
<html xmlns:wb="http://open.weibo.com/wb">
<head>
    <script id="allmobilize" charset="utf-8" src="style/js/allmobilize.min.js"></script>
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <link rel="alternate" media="handheld"  />
    <!-- end 云适配 -->
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>全国-公司列表-拉勾网-最专业的互联网招聘平台</title>
    <meta property="qc:admins" content="23635710066417756375" />
    <meta content="全国condition-condition-公司列表-拉勾网-最专业的互联网招聘平台" name="description">
    <meta content="全国condition-公司列表-拉勾网-最专业的互联网招聘平台" name="keywords">
    <meta name="baidu-site-verification" content="QIQ6KC1oZ6" />

    <!-- <div class="web_root"  style="display:none">h</div> -->
    <script type="text/javascript">
        var ctx = "h";
        console.log(1);
    </script>
    <link rel="stylesheet" type="text/css" href="/style/css/style.css"/>
    <link rel="stylesheet" type="text/css" href="/style/css/external.min.css"/>
    <link rel="stylesheet" type="text/css" href="/style/css/popup.css"/>
    <script src="/style/js/jquery.1.10.1.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="/style/js/jquery.lib.min.js"></script>
    <script src="/style/js/ajaxfileupload.js" type="text/javascript"></script>
    <script type="text/javascript" src="/style/js/additional-methods.js"></script>
    <!--[if lte IE 8]>
    <script type="text/javascript" src="/style/js/excanvas.js"></script>
    <![endif]-->

    <script type="text/javascript" src="style/js/conv.js"></script>
</head>
<body>
<div id="body">

    @if($user == null)
        @include('headerAndFooter.headerNotLogin')
    @endif

    @if($user != null)
        @if($user['type'] == 1)
            @include('headerAndFooter.headerType1Login')
        @endif

        @if($user['type'] == 0)
            @include('headerAndFooter.headerType0Login')
        @endif
    @endif

    <div id="container">

        <div class="clearfix">
            <div class="content_l">

                    <ul class="hc_list reset">
                        @foreach($companies as $company)
                        <li>
                            <a href="/company/show/{{$company['id']}}" target="_blank">
                                <h3 title="{{$company['name']}}">{{$company['name']}}</h3>
                                <div class="comLogo">
                                    <img src="/uploads/{{$company['logo']}}" width="190" height="190" alt="{{$company['name']}}" />
                                    <ul>
                                        <li>{{$company->trade['name']}}</li>
                                        <li>{{$company['city']}}，{{$company['stage']}}</li>
                                    </ul>
                                </div>
                            </a>
                            <ul class="reset ctags">
                                <li>{{$company['scale']}}</li>
                                @foreach($company->tags as $tag)
                                <li>{{$tag['name']}}</li>
                                @endforeach
                            </ul>
                        </li>
                        @endforeach
                    </ul>


            </div>
        </div>


        <script type="text/javascript" src="/style/js/company_list.min.js"></script>
        <div class="clear"></div>
        <input type="hidden" id="resubmitToken" value="" />
        <a id="backtop" title="回到顶部" rel="nofollow"></a>
    </div><!-- end #container -->
</div><!-- end #body -->

@include('headerAndFooter.footer')
<script type="text/javascript" src="/style/js/core.min.js"></script>
<script type="text/javascript" src="/style/js/popup.min.js"></script>

<!--  -->

</body>
</html>