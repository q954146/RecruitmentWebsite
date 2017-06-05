<!DOCTYPE HTML>
<html>
<head>
    <script id="allmobilize" charset="utf-8" src="/style/js/allmobilize.min.js"></script>
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <link rel="alternate" media="handheld"  />
    <!-- end 云适配 -->
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>传媒之家-最专业的传媒领域招聘平台</title>
    <meta property="qc:admins" content="23635710066417756375" />
    <meta content="" name="description">
    <meta content="" name="keywords">
    <meta name="baidu-site-verification" content="QIQ6KC1oZ6" />

    <link rel="Shortcut Icon" href="/images/favicon.ico">
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

    <script type="text/javascript" src="/style/js/conv.js"></script>
</head>
<body style="min-height:1000px">


<div id="body">
    @yield('header')
    <div id="container">


        <div id="sidebar">
            <div class="mainNavs">
                @for($i = 0;$i<count($categoriesZ);$i ++)
                    <div class="menu_box">
                        <div class="menu_main">
                            <h2>{{$categoriesZ[$i]['name']}} <span></span></h2>
                            {{--@foreach($categoryArrs[$i] as $categoryArr)--}}
                                {{--<a href="h/jobs/list_Java?labelWords=label">{{$categoryArr['name']}}</a>--}}
                            {{--@endforeach--}}
                        </div>
                        <div class="menu_sub dn" style="top: 0px;">
                            <dl class="reset">
                                <dd>
                                    @foreach($categoryArrs[$i] as $categoryArr)
                                        <a href="/category/{{$categoryArr['id']}}">{{$categoryArr['name']}}</a>
                                    @endforeach
                                </dd>
                            </dl>
                        </div>
                    </div>
                @endfor
            </div>

        </div>
        <div class="content">
            <div id="search_box">
                <form id="searchForm" name="searchForm" action="/search" method="post">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <select id="searchType" name="searchType" form="searchForm">
                        <option value="1" class="type_selected">职位</option>
                        <option value="2">公司</option>
                    </select>
                    <div class="searchtype_arrow"></div>
                    <input type="text" id="search_input" name = "content"  tabindex="1" value=""  placeholder="请输入职位名称，如：产品经理"  />
                    <input type="submit" id="search_button" value="搜索" />
                </form>
            </div>
            <style>
                .ui-autocomplete{width:488px;background:#fafafa !important;position: relative;z-index:10;border: 2px solid #91cebe;}
                .ui-autocomplete-category{font-size:16px;color:#999;width:50px;position: absolute;z-index:11; right: 0px;/*top: 6px; */text-align:center;border-top: 1px dashed #e5e5e5;padding:5px 0;}
                .ui-menu-item{ *width:439px;vertical-align: middle;position: relative;margin: 0px;margin-right: 50px !important;background:#fff;border-right: 1px dashed #ededed;}
                .ui-menu-item a{display:block;overflow:hidden;}
            </style>
            <script type="text/javascript" src="/style/js/search.min.js"></script>
            <ul class="reset hotabbing">
                <li class="current">最新职位</li>
            </ul>
            <div id="hotList">
                <ul class="hot_pos reset">
                    @foreach($professions as $profession)
                    <li class="clearfix">
                        <div class="hot_pos_l">
                            <div class="mb10">
                                <a href="/profession/show/{{$profession['id']}}" target="_blank">{{$profession['name']}}</a>
                                &nbsp;
                                <span class="c9">[{{$profession['city']}}]</span>
                            </div>
                            <span><em class="c7">月薪： </em>{{$profession['salaryLow']}}-{{$profession['salaryHigh']}}</span>
                            <span><em class="c7">经验：</em> {{$profession['workYear']}}</span>
                            <span><em class="c7">最低学历： </em>{{$profession['edu']}}</span>
                            <br />
                            <span><em class="c7">职位诱惑：</em>{{$profession['welfare']}}</span>
                            <br />
                            <span>{{$profession['created_at']}}</span>
                            <!-- <a  class="wb">分享到微博</a> -->
                        </div>
                        <div class="hot_pos_r">
                            <div class="mb10 recompany"><a href="/company/show/{{$profession['company']['id']}}" target="_blank">{{$profession['company']['name']}}</a></div>
                            <span><em class="c7">领域：</em>{{$profession['company']['trade']['name']}}</span>
                            {{--<span><em class="c7">创始人：</em>陈桦</span>--}}
                            <br />
                            <span><em class="c7">阶段：</em>{{$profession['company']['state']}}</span>
                            <span><em class="c7">规模：</em>{{$profession['company']['scale']}}</span>
                            <ul class="companyTags reset">
                                @foreach($profession['company']['tags'] as $tag)
                                <li>{{$tag['name']}}</li>
                                @endforeach
                            </ul>
                        </div>
                    </li>
                    @endforeach
                </ul>

            </div>

            <div class="clear"></div>
        </div>

        <script type="text/javascript" src="/style/js/Chart.min.js"></script>
        <script type="text/javascript" src="/style/js/home.min.js"></script>
        <script type="text/javascript" src="/style/js/count.js"></script>
        <div class="clear"></div>
        <input type="hidden" value="13ae35fedd9e45cdb66fb712318d7369" id="resubmitToken">
        <a rel="nofollow" title="回到顶部" id="backtop" style="display: none;"></a>
    </div><!-- end #container -->

</div><!-- end #body -->


@include('headerAndFooter.footer')

<script type="text/javascript" src="/style/js/core.min.js"></script>
<script type="text/javascript" src="/style/js/popup.min.js"></script>

<!-- <script src="style/js/wb.js" type="text/javascript" charset="utf-8"></script>
 -->

</body>
</html>
