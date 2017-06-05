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
                    已查看简历 <span>（共<i style="color:#fff;font-style:normal" id="positionNumber">{{count($resumes)}}</i>个）</span>
                </h1>
                </dt>
                <dd>
                    @if($resumes != null)
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
                                        {{--<a class="job_refresh" href="javascript:void(0)">刷新<span>每个职位7天内只能刷新一次</span></a>--}}
                                        {{--<a target="_blank" class="job_edit" href="create.html?positionId=149594">编辑</a>--}}
                                        <a class="job_offline" href="/resume/pending/{{$resume['id']}}/{{$resume['profession_id']}}">简历通过</a>
                                        <a class="job_del" href="/resume/inappropriate/{{$resume['id']}}/{{$resume['profession_id']}}">不合适</a>
                                    </div>
                                </li>
                            </ul>
                        @endforeach
                    @endif
                </dd>
            </dl>
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


</body>
</html>