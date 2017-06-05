<!DOCTYPE HTML>
<html>
<head>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>传媒之家-最专业的传媒领域招聘平台</title>

    <script type="text/javascript">
        var ctx = "http://123.207.137.43";
        console.log(1);
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
@include('headerAndFooter.headerType0Login')

    <div id="container">

        <div class="clearfix">
            <div class="content_l">
                <dl class="c_collections">
                    <dt>
                    <h1><em></em>我收藏的职位</h1>
                    </dt>
                    <dd>
                        <form id="collectionsForm">
                            <ul class="reset my_collections">

                                @if(count($professions)>0)
                                    @foreach($professions as $profession)
                                        <li>
                                    <a title="{{$profession['name']}}" target="_blank" href="/company/show/{{$profession->user->company['id']}}">
                                        <img alt="{{$profession->user->company['name']}}" src="/uploads/{{$profession->user->company['logo']}}">
                                    </a>
                                    <div class="co_item">
                                        <h2 title="酒店业务助理">
                                            <a target="_blank" href="/profession/show/{{$profession['id']}}">
                                                <em>{{$profession['name']}}</em>
                                                <span>（{{$profession['salaryLow']}}-{{$profession['salaryHigh']}}）</span>
                                            </a>
                                        </h2>
                                        <span class="co_time">发布时间：{{$profession['created_at']}}</span>
                                        <div class="co_cate">{{$profession->user->company['name']}} / {{$profession['city']}} / {{$profession['workYear']}}/ {{$profession['edu']}}</div>
                                        <span class="co_youhuo c7">{{$profession['welfare']}}</span>
                                        <input type="hidden" name="id" value="{{$profession['id']}}">
                                        @if($profession['send'] == null)
                                            <a class="collection_link" target="_blank" onclick="showPop()">投个简历</a>
                                        @endif

                                        @if($profession['send'] != null)
                                            <p class="collection_link">已投递</p>
                                        @endif

                                        <i></i>
                                        <form action="/postCancelCollection">
                                            <input class="collectionCancel collection_link collected" type="submit" name="submit" onclick="cancel()" value="取消收藏">
                                        </form>
                                    </div>
                                </li>
                                    @endforeach
                                @endif
                            </ul>
                        </form>
                    </dd>
                </dl>
            </div>

        </div>
        {{--<script src="/style/js/collections.min.js"></script>--}}
        <div class="clear"></div>
        <input type="hidden" value="13ae35fedd9e45cdb66fb712318d7369" id="resubmitToken">
        <a rel="nofollow" title="回到顶部" id="backtop" style="display: none;"></a>
    </div><!-- end #container -->
</div><!-- end #body -->
@include('headerAndFooter.footer')

{{--<script src="/style/js/core.min.js" type="text/javascript"></script>--}}

{{--<script src="/style/js/popup.min.js" type="text/javascript"></script>--}}



<div id="cboxOverlay" style="display: none;"></div><div id="colorbox" class="" role="dialog" tabindex="-1" style="display: none;"><div id="cboxWrapper"><div><div id="cboxTopLeft" style="float: left;"></div><div id="cboxTopCenter" style="float: left;"></div><div id="cboxTopRight" style="float: left;"></div></div><div style="clear: left;"><div id="cboxMiddleLeft" style="float: left;"></div><div id="cboxContent" style="float: left;"><div id="cboxTitle" style="float: left;"></div><div id="cboxCurrent" style="float: left;"></div><button type="button" id="cboxPrevious"></button><button type="button" id="cboxNext"></button><button id="cboxSlideshow"></button><div id="cboxLoadingOverlay" style="float: left;"></div><div id="cboxLoadingGraphic" style="float: left;"></div></div><div id="cboxMiddleRight" style="float: left;"></div></div><div style="clear: left;"><div id="cboxBottomLeft" style="float: left;"></div><div id="cboxBottomCenter" style="float: left;"></div><div id="cboxBottomRight" style="float: left;"></div></div></div><div style="position: absolute; width: 9999px; visibility: hidden; display: none;"></div></div>
</body>
</html>
<script src="/style/js/deliverUp.js" type="text/javascript"></script>

