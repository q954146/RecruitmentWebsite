<!DOCTYPE HTML>
<html>
<head>
    {{--<script id="allmobilize" charset="utf-8" src="/style/js/allmobilize.min.js"></script>--}}
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <link rel="alternate" media="handheld"  />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title></title>

    <link rel="stylesheet" type="text/css" href="/style/css/style.css"/>
    <link rel="stylesheet" type="text/css" href="/style/css/external.min.css"/>
    <link rel="stylesheet" type="text/css" href="/style/css/popup.css"/>
    <script type="text/javascript" src="/style/js/jquery.1.10.1.min.js"></script>
    <script src="/style/js/jquery.lib.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="/style/js/ajaxfileupload.js"></script>
    <script src="/style/js/additional-methods.js" type="text/javascript"></script>

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
                <dl class="job_detail">
                    <dt>
                    <h1 title="内容运营">
                        <em></em>
                        <div>
                            @if($profession['branch'] != '')
                            {{$profession['branch']}}招聘
                            @endif
                        </div>
                        {{$profession['name']}}
                    </h1>

                    @if($user != null)
                    <div class="jd_collection" id="JobCollection" onclick="collection()"></div>
                    <div id="judge" style="display: none">{{$profession['collection']}}</div>
                    @endif

                    </dt>
                    <dd class="job_request">
                        <span class="red">{{$profession['salaryHigh']}}-{{$profession['salaryLow']}}</span>
                        <span>{{$profession['city']}}</span>
                        <span>经验{{$profession['workYear']}} </span>
                        <span> {{$profession['edu']}}</span>
                        <span>{{$profession['nature']}}</span><br />
                        职位诱惑 :{{$profession['welfare']}}
                        <div>发布时间：{{$profession['created_at']}}</div>
                    </dd>
                    <dd class="job_bt">
                        <h3 class="description">职位描述</h3>
                        {{$profession['desc']}}
                    </dd>

                    @if($user == null)
                        <dd>
                            <a href="/auth/login" title="登录" class="inline btn fr btn_apply">登录</a>
                        </dd>
                    @endif

                    @if($user != null)
                        @if($user['type'] == 1)
                        @endif

                        @if($user['type'] == 0)
                            @if($profession['send'] == null)
                                <input type="hidden" name="id" value="{{$profession['id']}}">
                                <dd>
                                    <a title="登录" class="inline btn fr btn_apply" onclick="showPop()">投个简历</a>
                                </dd>
                            @endif

                            @if($profession['send'] != null)
                                    <dd>
                                        <p class="inline btn fr btn_apply">您已经投递过该公司</p>
                                    </dd>
                            @endif
                        @endif
                    @endif

                </dl>
            </div>
            <div class="content_r">
                <dl class="job_company">
                    <dt>
                        <a href="/company/show/{{$profession->user->company['id']}}" target="_blank">
                            <img class="b2" src="/uploads/{{$profession->user->company['logo']}}" width="80" height="80" alt="{{$profession->user->company['name']}}" />
                            <div>
                                <h2 class="fl">
                                    {{$profession->user->company['name']}}
                                    <img src="/style/images/valid.png" width="15" height="19" alt="拉勾认证企业" />
                                    <span class="dn">拉勾认证企业</span>

                                </h2>
                            </div>
                        </a>
                    </dt>
                    <dd>
                        <ul class="c_feature reset">
                            <li><span>领域</span> {{$company->trade['name']}}</li>
                            <li><span>规模</span>{{$company['scale']}}</li>
                            <li>
                                <span>主页</span>
                                <a href="{{$company['web']}}" target="_blank" title="{{$company['web']}}" rel="nofollow">{{$company['web']}}</a>
                            </li>
                        </ul>

                        <h4>发展阶段</h4>
                        <ul class="c_feature reset">
                            <li><span>目前阶段</span> {{$company['stage']}}</li>
                        </ul>

                    </dd>
                </dl>

            </div>
        </div>

        <div id="tipOverlay" ></div>



        <div class="clear"></div>
        <input type="hidden" id="resubmitToken" value="6e1925fdbe7142468f154abd1d33f5a8" />
        <a id="backtop" title="回到顶部" rel="nofollow"></a>
    </div><!-- end #container -->
</div><!-- end #body -->
@include('headerAndFooter.footer')

</body>
</html>
<script src="/style/js/deliverUp.js" type="text/javascript"></script>
<script>
    if($("#judge").html()=="1"){
        $("#JobCollection").css("background-positionY","-71px");
    }
</script>