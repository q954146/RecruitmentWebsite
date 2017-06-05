<!DOCTYPE HTML><head>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type">
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
                <dl class="c_delivery">
                    <dt>
                    <h1><em></em>已投递简历状态</h1>
                    </dt>
                    <dd>
                        <div class="delivery_tabs">
                            <ul class="reset">
                                <li class="current">
                                    <a href="/resume/delivery/0">全部</a>
                                </li>
                                <li>
                                    <a href="/resume/delivery/1">投递成功</a>
                                </li>
                                <li>
                                    <a href="/resume/delivery/2">被查看</a>
                                </li>
                                <li>
                                    <a href="/resume/delivery/3">待沟通</a>
                                </li>
                                <li>
                                    <a href="/resume/delivery/4">邀请面试</a>
                                </li>
                                <li class="last">
                                    <a href="/resume/delivery/5">不合适</a>
                                </li>
                            </ul>
                        </div>

                        @section('delivery')

                        @show
                    </dd>
                </dl>
            </div>
            <div class="content_r">
                <div class="mycenterR" id="myInfo">
                    <h2>我的信息</h2>
                    <a href="/collection">我收藏的职位</a>
                </div><!--end #myInfo--></div>
        </div>
        <input type="hidden" id="userid" name="userid" value="314873">
        <div class="dn" id="recordPopBox">
            <dl>
                <dt>
                    评价面试体验
                    <a class="boxclose" href="javascript:;"></a>
                </dt>
                <dd>
                    <form id="recordForm">
                        <input type="hidden" value="" id="recordId">
                        <ul id="interviewResult" class="record_radio clearfix">
                            <li class="mr35">
                                已收到offer
                                <input type="radio" name="type" value="1">
                            </li>
                            <li>
                                未收到offer
                                <input type="radio" name="type" value="2">
                            </li>
                        </ul>
                        <div class="dividebtm">
                            <table>
                                <tbody><tr>
                                    <td width="80" valign="top" align="right">面试评分：</td>
                                    <td>
                                        <ul id="recordStarSelect">
                                            <li></li>
                                            <li></li>
                                            <li></li>
                                            <li></li>
                                            <li></li>
                                        </ul>
                                        <input type="hidden" id="recordStar" value="" name="recordStar">
                                        <div class="clear"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td valign="top" align="right" class="dividebtman">面试短评：</td>
                                    <td>

                                        <input type="hidden" class="error" id="select_record_hidden" value="" name="record">
                                        <input type="text" autocomplete="off" placeholder="15字以内对面试的简单描述哦" id="select_record" class="selectr_340" maxlength="15">
                                        <div class="boxUpDownan boxUpDown_340 dn" id="box_record" style="display: none;">
                                            <ul>
                                                <p>热门短评：</p>
                                                <li></li>
                                                <li></li>
                                                <li></li>
                                                <li></li>
                                                <li></li>
                                                <li></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td valign="top" align="right" class="dividebtman">面试经历：</td>
                                    <td>
                                        <textarea id="interviewDesc" placeholder="记录下自己的面试经历" style="width: 320px;"></textarea>
                                        <div class="word_count">你还可以输入 <span>500</span> 字</div>
                                        <div id="showName" class="f14 c7">
                                            <label class="checkbox">
                                                <input type="checkbox">
                                                <i></i>
                                            </label>
                                            匿名提交
                                        </div>
                                        <input type="hidden" value="" id="isShowName">
                                        <input type="hidden" value="" id="senduid">
                                        <input type="hidden" value="" id="poid">
                                        <input type="hidden" value="" id="deid">
                                    </td>
                                </tr>
                                <tr>
                                    <td align="right" colspan="2">
                                        <input type="submit" value="确认提交" class="submitRecord btn_small">
                                    </td>
                                </tr>
                                </tbody></table>
                        </div>
                    </form>
                </dd>
            </dl>
        </div><!-- end #recordPopBox -->
        <script src="/style/js/delivery.js"></script>
        <script>
            $(function(){
                //location.reload(true);

                $('.Pagination').pager({
                    currPage: 1,
                    pageNOName: "pageNo",
                    form: "deliveryForm",
                    pageCount: 1,
                    pageSize:  5
                });
            });
        </script>
        <div class="clear"></div>
        <input type="hidden" value="13ae35fedd9e45cdb66fb712318d7369" id="resubmitToken">
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

<div id="cboxOverlay" style="display: none;"></div><div id="colorbox" class="" role="dialog" tabindex="-1" style="display: none;"><div id="cboxWrapper"><div><div id="cboxTopLeft" style="float: left;"></div><div id="cboxTopCenter" style="float: left;"></div><div id="cboxTopRight" style="float: left;"></div></div><div style="clear: left;"><div id="cboxMiddleLeft" style="float: left;"></div><div id="cboxContent" style="float: left;"><div id="cboxTitle" style="float: left;"></div><div id="cboxCurrent" style="float: left;"></div><button type="button" id="cboxPrevious"></button><button type="button" id="cboxNext"></button><button id="cboxSlideshow"></button><div id="cboxLoadingOverlay" style="float: left;"></div><div id="cboxLoadingGraphic" style="float: left;"></div></div><div id="cboxMiddleRight" style="float: left;"></div></div><div style="clear: left;"><div id="cboxBottomLeft" style="float: left;"></div><div id="cboxBottomCenter" style="float: left;"></div><div id="cboxBottomRight" style="float: left;"></div></div></div><div style="position: absolute; width: 9999px; visibility: hidden; display: none;"></div></div></body></html>