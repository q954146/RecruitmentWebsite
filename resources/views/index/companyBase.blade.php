<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>公司详情</title>
    <link href="/style/css/style.css" rel="stylesheet" type="text/css">
    <link href="/style/css/style1.css" rel="stylesheet" type="text/css">
</head>
<body>

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

<!--顶部信息-->
<div class="top_info">
    <div class="top_info_wrap">
        <img src="/uploads/{{$company['logo']}}" alt="{{$company['name']}}Logo" width="164" height="164">
        <div class="company_info">
            <div class="company_main">
                <h1>
                    <a href="{{$company['web']}}" class="hovertips" target="_blank" rel="nofollow" title="{{$company['name']}}">
                        {{$company['name']}}
                    </a>
                </h1>

                <a href="{{$company['web']}}" class="icon-wrap" target="_blank" rel="nofollow" title="{{$company['web']}}">
                    <i></i>
                </a>
                @if($company['state'] == 1)
                <a class="identification" title="传媒认证企业">
                    <i></i>
                    <span>传媒认证</span>
                </a>
                @endif

                <div class="company_word">
                    {{$company['oneDesc']}}
                </div>
            </div>

        </div>
    </div>
</div>
<!--顶部信息 end-->

<!--公司详情菜单-->
<div id="company_navs" class="company_navs">
    <div class="company_navs_wrap">
        <ul >
            <li class="current">
                <a href="/company/show/{{$company['id']}}" >公司主页</a>
            </li>
            <li>
                <a href="/companyAsk/show/{{$company['id']}}">公司问答</a>
                <i class="icon_new"></i>
            </li>
        </ul>
    </div>
</div>
<!--公司详情菜单 end-->

<div id="main_container">


    @section('left')

    @show

    <div id="container_right">

        <!--公司基本信息-->
        <div class="item_container" id="basic_container">
            <div class="item_ltitle">公司基本信息</div>
            <div class="item_content">
                <ul>
                    <li>
                        <i class="type"></i>
                        <span>{{$company['trade']}}</span>
                    </li>
                    <li>
                        <i class="process"></i>
                        <span>{{$company['stage']}}</span>
                    </li>
                    <li>
                        <i class="number"></i>
                        <span>{{$company['scale']}}</span>
                    </li>
                    <li>
                        <i class="address"></i>
                        <span>{{$company['city']}}</span>
                    </li>
                </ul>
            </div>
        </div>
        <!--公司基本信息 end-->

        <!--管理团队-->
        <div class="company_managers item_container" id="company_managers">
            <div class="item_ltitle">管理团队</div>

            @if(count($teams) > 0)
                @foreach($teams as $team)
                    <div class="company_mangers_item">
                        <div class="managelist_wrap">
                            <ul class="manager_list" style="width: 750px; left: 0px;">
                                <li class="item_has rotate_item  rotate_active " style="float: left;">
                                    <img class="item_manger_photo_show" src="/uploads/{{$team['image']}}" alt="创始人头像" width="118" height="118">
                                    <p class="item_manager_name">
                                        <span>{{$team['name']}}</span>
                                    </p>
                                    <p class="item_manager_title">{{$team['position']}}</p>
                                    <div class="item_manager_content mCustomScrollbar _mCS_1">
                                        <div class="mCustomScrollBox mCS-dark-2" id="mCSB_1" style="position:relative; height:100%; overflow:hidden; max-width:100%;">
                                            <div class="mCSB_container mCS_no_scrollbar" style="position:relative; top:0;">
                                                {{$team['desc']}}
                                                <p>&nbsp;</p>
                                                <p><br></p>
                                            </div>
                                            <div class="mCSB_scrollTools" style="position: absolute; display: none;">
                                                <div class="mCSB_draggerContainer">
                                                    <div class="mCSB_dragger" style="position: absolute; top: 0px;" oncontextmenu="return false;">
                                                        <div class="mCSB_dragger_bar" style="position:relative;">
                                                        </div>
                                                    </div>
                                                    <div class="mCSB_draggerRail">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                @endforeach
            @endif
        </div>
        <!--管理团队 end-->

        <!--公司标签-->
        <div class="tags_container item_container" id="tags_container">
            <div class="item_ltitle">公司标签</div>
            <div class="tags_warp">
                <div class="item_content">
                    <ul class="item_con_ul clearfix">
                        @foreach($tags as $tag)
                            <li class="con_ul_li">
                                {{$tag}}
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <!--公司标签 end-->
    </div>
</div>

@include('headerAndFooter.footer')
</body>
</html>