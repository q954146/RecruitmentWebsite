<!DOCTYPE HTML>
<html>
<body>
<head>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type">
    <title>传媒之家-最专业的传媒领域招聘平台</title>

    <script type="text/javascript">
        var ctx = "http://123.207.137.43";
        console.log(1);
    </script>
    <!-- 下拉选择框 -->

    <!-- <div class="web_root"  style="display:none">http://www.lagou.com</div> -->

    <link href="http://www.lagou.com/images/favicon.ico" rel="Shortcut Icon">
    <link href="/style/css/style.css" type="text/css" rel="stylesheet">
    <link href="/style/css/external.min.css" type="text/css" rel="stylesheet">
    <link href="/style/css/popup.css" type="text/css" rel="stylesheet">
    <script type="text/javascript" src="/style/js/jquery.1.10.1.min.js"></script>
    <script src="/style/js/jquery.lib.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="/style/js/ajaxfileupload.js"></script>
    <script src="/style/js/additional-methods.js" type="text/javascript"></script>
<body>
<div id="body">
    @include('headerAndFooter.headerType1Login')
    <div style="clear: both"></div>
    <div id="container">

        @include('recruitment.sidebar')
        <div class="content">
            <dl class="company_center_content">
                <dt>
                <h1>
                    <em></em>
                    有效职位 <span>（共<i style="color:#fff;font-style:normal" id="positionNumber">{{count($professions)}}</i>个）</span>
                </h1>
                </dt>
                <dd>
                        @if(count($professions) > 0)
                        @foreach($professions as $profession)
                        <ul class="reset my_jobs">
                            <li data-id="149594">
                                <h3>
                                    <a target="_blank" title="{{$profession['name']}}" href="#">{{$profession['name']}}</a>
                                    <span>{{$profession['city']}}</span>
                                </h3>
                                <div>{{$profession['nature']}} / {{$profession['salaryLow']}}-{{$profession['salaryHigh']}} / {{$profession['workYear']}} / {{$profession['edu']}}</div>
                                <div class="c9">发布时间： {{$profession['created_at']}}</div>
                                <div class="links">
                                    {{--<a class="job_refresh" href="javascript:void(0)">刷新<span>每个职位7天内只能刷新一次</span></a>--}}
                                    {{--<a target="_blank" class="job_edit" href="create.html?positionId=149594">编辑</a>--}}
                                    <a class="job_offline" href="/downLineProfession/{{$profession['id']}}">下线</a>
                                    {{--<a class="job_del" href="javascript:void(0)">删除</a>--}}
                                </div>
                            </li>
                        </ul>
                        @endforeach
                        @endif
                </dd>
            </dl>
        </div><!-- end .content -->
        {{--<script src="/style/js/job_list.min.js" type="text/javascript"></script>--}}
        <div class="clear"></div>
        <a rel="nofollow" title="回到顶部" id="backtop" style="display: none;"></a>
    </div><!-- end #container -->
</div><!-- end #body -->
@include('headerAndFooter.footer')

<script src="/style/js/core.min.js" type="text/javascript"></script>

<script src="/style/js/popup.min.js" type="text/javascript"></script>

<!--  -->

<script type="text/javascript">
    $(function(){
        $('#noticeDot-1').hide();
        $('#noticeTip a.closeNT').click(function(){
            $(this).parent().hide();
        });
    });
    var index = Math.floor(Math.random() * 2);
    var ipArray = new Array('42.62.79.226','42.62.79.227');
    var url = "ws://" + ipArray[index] + ":18080/wsServlet?code=314873";
    var CallCenter = {
        init:function(url){
            var _websocket = new WebSocket(url);
            _websocket.onopen = function(evt) {
                console.log("Connected to WebSocket server.");
            };
            _websocket.onclose = function(evt) {
                console.log("Disconnected");
            };
            _websocket.onmessage = function(evt) {
                //alert(evt.data);
                var notice = jQuery.parseJSON(evt.data);
                if(notice.status[0] == 0){
                    $('#noticeDot-0').hide();
                    $('#noticeTip').hide();
                    $('#noticeNo').text('').show().parent('a').attr('href',ctx+'/mycenter/delivery.html');
                    $('#noticeNoPage').text('').show().parent('a').attr('href',ctx+'/mycenter/delivery.html');
                }else{
                    $('#noticeDot-0').show();
                    $('#noticeTip strong').text(notice.status[0]);
                    $('#noticeTip').show();
                    $('#noticeNo').text('('+notice.status[0]+')').show().parent('a').attr('href',ctx+'/mycenter/delivery.html');
                    $('#noticeNoPage').text(' ('+notice.status[0]+')').show().parent('a').attr('href',ctx+'/mycenter/delivery.html');
                }
                $('#noticeDot-1').hide();
            };
            _websocket.onerror = function(evt) {
                console.log('Error occured: ' + evt);
            };
        }
    };
    CallCenter.init(url);
</script>

<div id="cboxOverlay" style="display: none;"></div><div id="colorbox" class="" role="dialog" tabindex="-1" style="display: none;"><div id="cboxWrapper"><div><div id="cboxTopLeft" style="float: left;"></div><div id="cboxTopCenter" style="float: left;"></div><div id="cboxTopRight" style="float: left;"></div></div><div style="clear: left;"><div id="cboxMiddleLeft" style="float: left;"></div><div id="cboxContent" style="float: left;"><div id="cboxTitle" style="float: left;"></div><div id="cboxCurrent" style="float: left;"></div><button type="button" id="cboxPrevious"></button><button type="button" id="cboxNext"></button><button id="cboxSlideshow"></button><div id="cboxLoadingOverlay" style="float: left;"></div><div id="cboxLoadingGraphic" style="float: left;"></div></div><div id="cboxMiddleRight" style="float: left;"></div></div><div style="clear: left;"><div id="cboxBottomLeft" style="float: left;"></div><div id="cboxBottomCenter" style="float: left;"></div><div id="cboxBottomRight" style="float: left;"></div></div></div><div style="position: absolute; width: 9999px; visibility: hidden; display: none;"></div></div><div class="ui-datepicker ui-widget ui-widget-content ui-helper-clearfix ui-corner-all" id="ui-datepicker-div"></div>
</body>
</html>