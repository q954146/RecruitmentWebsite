
<!DOCTYPE HTML><head>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type">
    <title>传媒之家-最专业的传媒领域招聘平台</title>

    <script type="text/javascript">
        var ctx = "http://123.207.137.43";
        console.log(1);
    </script>
    <!-- 下拉选择框 -->

    <!-- <div class="web_root"  style="display:none">http://www.lagou.com</div> -->
    <link rel="stylesheet" href="/style/css/style1.css">
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
                    待定简历  <span>（共{{count($resumes)}}份）</span>
                </h1>
                </dt>
                <dd>
                    @if(count($resumes) > 0)
                        @foreach($resumes as $resume)
                            <ul class="reset my_jobs">
                                <li data-id="149594">
                                    <h3>
                                        <a target="_blank" title="{{$resume['name']}}" href="#">{{$resume['name']}}的简历</a>
                                        <span></span>
                                    </h3>
                                    <div class="c9">投递时间： {{$resume['created_at']}}</div>
                                    <div>{{$resume['name']}}/{{$resume['sex']}}/{{$resume['education']}}/{{$resume['workYear']}}</div>
                                    <div class="c9">投递职位： {{$resume['profession']}}</div>

                                    <div class="links">
                                        <a  class="resume_notice" onclick="showPop()">通知面试</a>
                                        <a data-deliverid="1686182" class="resume_refuse" href="/resume/inappropriate/{{$resume['id']}}/{{$resume['profession_id']}}">不合适</a>
                                    </div>
                                </li>
                            </ul>

                            <!--通知面试弹窗 后加-->
                            <div class="noticeInterview_bg" id="noticeInterview_bg" style="display: none;">
                                <div class="noticeInterview_wrapper">
                                    <form id="noticeInterview_Form" method="post" action="/resume/audition">

                                        <input type="hidden" name="_token" value="{{csrf_token()}}">

                                        <input type="hidden" name="resumeId" value="{{$resume['id']}}">
                                        <input type="hidden" name="professionId" value="{{$resume['profession_id']}}">

                                        <table width="100%" class="noticeInterviewTable">
                                            <tbody>
                                            <tr>
                                                <td align="right"><span class="notice_redstar">*</span>面试时间</td>
                                                <td>
                                                    <input type="date" id="auditionTime" name="auditionTime" >
                                                </td>
                                            </tr>

                                            <tr>
                                                <td align="right"><span class="notice_redstar">*</span>面试地点</td>
                                                <td>
                                                    <input type="text" id="auditionAddress" name="auditionAddress" >
                                                </td>
                                            </tr>

                                            <tr>
                                                <td align="right"><span class="notice_redstar">*</span>联系人</td>
                                                <td>
                                                    <input type="text" id="linkMan" name="linkMan">
                                                </td>
                                            </tr>

                                            <tr>
                                                <td align="right"><span class="notice_redstar">*</span>联系电话</td>
                                                <td>
                                                    <input type="text" id="linkPhone" name="linkPhone" >
                                                </td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td>
                                                    <input type="submit" value="发送" class="notebtn">
                                                    <input type="button" value="关闭" class="notebtn" onclick="closePop()">
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </form>
                                </div>
                            </div>
                            <!--/#noticeInterview-->
                        @endforeach
                    @endif
                </dd>
            </dl><!-- end .company_center_content -->
        </div><!-- end .content -->

        <script src="/style/js/jquery.ui.datetimepicker.min.js" type="text/javascript"></script>
        <script src="/style/js/received_resumes.min.js" type="text/javascript"></script>
        <script>
        </script>
        <div class="clear"></div>
        <input type="hidden" value="13ae35fedd9e45cdb66fb712318d7369" id="resubmitToken">
        <a rel="nofollow" title="回到顶部" id="backtop" style="display: none;"></a>
    </div><!-- end #container -->
</div><!-- end #body -->



@include('headerAndFooter.footer')

<script src="/style/js/core.min.js" type="text/javascript"></script>

<script src="/style/js/popup.min.js" type="text/javascript"></script>

<!--  -->

<script type="text/javascript">

    //显示弹窗
    function showPop() {
        $("#noticeInterview_bg").fadeIn("slow");
    }
    function closePop() {
        $("#noticeInterview_bg").fadeOut("slow");
    }
</script>
</body>
</html>