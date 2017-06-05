<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="/style/css/style.css" rel="stylesheet" type="text/css">
    <link href="/style/css/style1.css" rel="stylesheet" type="text/css">
    <link href="/style/css/jianli.css" rel="stylesheet" type="text/css">
    <meta charset=utf-8" http-equiv="Content-Type" name="csrf-token" content="{{ csrf_token() }}" />
    <script src="/style/js/jquery.1.10.1.min.js" type="text/javascript"></script>
    <title>简历</title>
    <style>
        .collection{
            font-size: 16px;
        }
        .upload_resume{
            width: 300px;
            height: 200px;
            border-radius: 10px;
            background: #ffe553;
            position: fixed;
            left: 500px;
            top: 200px;
            padding: 50px;
        }
    </style>
</head>
<body>

@include('headerAndFooter.headerType0Login')

<div class="content_mid" style="margin-top: 80px;padding-top: 30px">
    <h1>我的简历</h1>
    <a href="/collection" class="collection">收藏简历</a>
    <a class="collection" onclick="showupload()">上传简历</a>
    <!--上传头像-->
    <div class="upload_img">
        <div class="title">上传头像</div>
        <iv style="clear: both"></iv>
        <input type="file" id="upImg" name="upImg"  accept="image/png,image/jpg,image/jpeg,image/gif" onclick="check_img0()">
        <img src="/uploads/{{$resume['image']}}" class="perImg" id="perImg" width="120" height="120">
        <input type="hidden" value="" name="Picture" id="Picture">
    </div>
    <!--上传头像 end-->

    <!--基本信息-->
    <div class="box">
        <div class="title">基本信息</div>
        @if($resume != null)
        @endif

        <div id="infBox" style="display:block">
            <div class="button" id="infoEdit" onclick="upInfo() ">编辑</div>
            <span id="name">{{$resume['name']}}</span>&nbsp;|
            <span id="sex">{{$resume['sex']}}</span>&nbsp;|
            <span id="edu">{{$resume['education']}}</span>&nbsp;|
            <span id="exp">{{$resume['workYear']}}</span><br>
            手机号：<span id="tel">{{$resume['phone']}}</span> &nbsp;&nbsp;
            电子邮件：<span id="email">{{$resume['email']}}</span><br>
            当前状态：<span id="status">{{$resume['state']}}</span>
        </div>

        <form id="infoForm" style="display: none">
            <input type="text" placeholder="姓名" id="upName"><br>
            <span class="ridioText">男：</span>
            <input type="radio" checked="checked" name="Sex" value="男" />
            <span class="ridioText">女：</span>
            <input type="radio" name="Sex" value="女" />&nbsp;&nbsp;

            <span class="ridioText">请选择学历：</span>
            <select class="selEdu" id="selEdu">
                <option value="大专">大专</option>
                <option value="本科">本科</option>
                <option value="硕士">硕士</option>
                <option value="博士">博士</option>
                <option value="其他">其他</option>
            </select> <br>

            <span class="ridioText">请选择工作经验：</span>
            <select class="selExp" id="selExp">
                <option value="应届毕业生">应届毕业生</option>
                <option value="1年">1年</option>
                <option value="2年">2年</option>
                <option value="3年">3年</option>
                <option value="4年">4年</option>
                <option value="5年">5年</option>
                <option value="6年">6年</option>
                <option value="7年">7年</option>
                <option value="8年">8年</option>
                <option value="9年">9年</option>
                <option value="10年以上">10年以上</option>
            </select>
            <br>
            电话<input type="tel" placeholder="电话" id="upTel"><br>
            邮箱<input type="text" placeholder="邮箱" id="upEmail"><br>

            <span class="ridioText">请选择目前状态：</span>
            <select class="selStatus" id="selStatus">
                <option value="我目前已离职，可快速到岗">我目前已离职，可快速到岗</option>
                <option value="我是应届毕业生">我是应届毕业生</option>
                <option value="我目前正在职，正考虑换个新环境">我目前正在职，正考虑换个新环境</option>
                <option value="我暂时不想找工作"> 我暂时不想找工作</option>
            </select><br>

            <div class="subbutton" id="infoSava" onclick="saveInfo()">保存</div>
            <div class="subbutton" id="infoQuit" onclick="quitInfo()">取消</div>
        </form>
    </div>
    <!--基本信息 end-->

    <!--期望工作-->
    <div class="box">
        <div class="title">期望工作</div>
        <div id="hopeBox" style="display:block">
            <div class="button" id="hopeEdit" onclick="upHope()">编辑</div>
            期望城市：<span id="city">{{$hopeProfession['city']}}</span><br>
            工作类型：<span id="type">{{$hopeProfession['nature']}}</span><br>
            期望职位：<span id="position">{{$hopeProfession['profession']}}</span><br>
            期望月薪：<span id="pay">{{$hopeProfession['salary']}}</span>
        </div>

        <form id="hopeForm" style="display: none">
            <input type="text" placeholder="期望城市，如：北京" id="upcity">
            <br>
            <span class="ridioText">期望工作类型：</span>
            <input type="radio" checked="checked" name="type" value="全职" />
            <span class="ridioText">全职</span>
            <input type="radio" name="type" value="兼职" />
            <span class="ridioText">兼职</span>
            <input type="radio" name="type" value="实习" />
            <span class="ridioText">实习</span>
            <input type="text" placeholder="期望城市，如：产品经理" id="upposition">
            <input type="text" placeholder="期望月薪" id="uppay">

            <div class="subbutton" id="hopeSava" onclick="saveHope()">保存</div>
            <div class="subbutton" id="hopeQuit" onclick="quitHope()">取消</div>
        </form>
    </div>
    <!--期望工作 end-->

    <!--工作经历-->
    <div class="box">
        <div class="title">工作经历</div>
        <div id="workBox" style="display:block">
            <div class="button" id="workEdit" onclick="upWork()">编辑</div>
            公司名称：<span id="company">{{$workExperience['company']}}</span><br>
            职位名称：<span id="job">{{$workExperience['profession']}}</span><br>
            开始时间：<span id="workStaYear">{{$workExperience['beginYearTime']}}</span>年<span id="workStaMon">{{$workExperience['beginMonthTime']}}</span>月<br>
            结束时间：<span id="workEndYear">{{$workExperience['endYearTime']}}</span>年<span id="workEndMon">{{$workExperience['endMonthTime']}}</span>月<br>
        </div>

        <form id="workForm" style="display: none">
            <input type="text" placeholder="公司名称" id="upcompany">
            <input type="text" placeholder="职位名称" id="upjob"><br>
            <span class="ridioText">请选择工作开始时间：</span>
            <select class="upWorkStaYear" id="upWorkStaYear">
                <option value="2017">2017</option>
                <option value="2016">2016</option>
                <option value="2015">2015</option>
                <option value="2014">2014</option>
                <option value="2013">2013</option>
                <option value="2012">2012</option>
                <option value="2011">2011</option>
                <option value="2010">2010</option>
                <option value="2009">2009</option>
                <option value="2008">2008</option>
                <option value="2007">2007</option>
                <option value="2006">2006</option>
                <option value="2005">2005</option>
                <option value="2004">2004</option>
                <option value="2002">2003</option>
                <option value="2001">2001</option>
                <option value="2000">2000</option>
            </select>年
            <select class="upWorkStaMon" id="upWorkStaMon">
                <option value="12">12</option>
                <option value="11">11</option>
                <option value="10">10</option>
                <option value="9">9</option>
                <option value="8">8</option>
                <option value="7">7</option>
                <option value="6">6</option>
                <option value="5">5</option>
                <option value="4">4</option>
                <option value="3">3</option>
                <option value="2">2</option>
                <option value="1">1</option>
            </select>月
            <br>
            <span class="ridioText">请选择工作结束时间：</span>
            <select class="upWorkEndYear" id="upWorkEndYear">
                <option value="2017">2017</option>
                <option value="2016">2016</option>
                <option value="2015">2015</option>
                <option value="2014">2014</option>
                <option value="2013">2013</option>
                <option value="2012">2012</option>
                <option value="2011">2011</option>
                <option value="2010">2010</option>
                <option value="2009">2009</option>
                <option value="2008">2008</option>
                <option value="2007">2007</option>
                <option value="2006">2006</option>
                <option value="2005">2005</option>
                <option value="2004">2004</option>
                <option value="2002">2003</option>
                <option value="2001">2001</option>
                <option value="2000">2000</option>
            </select>年
            <select class="upWorkEndMon" id="upWorkEndMon">
                <option value="12">12</option>
                <option value="11">11</option>
                <option value="10">10</option>
                <option value="9">9</option>
                <option value="8">8</option>
                <option value="7">7</option>
                <option value="6">6</option>
                <option value="5">5</option>
                <option value="4">4</option>
                <option value="3">3</option>
                <option value="2">2</option>
                <option value="1">1</option>
            </select>月

            <br>
            <div class="subbutton" id="workSava" onclick="saveWork()">保存</div>
            <div class="subbutton" id="workQuit" onclick="quitWork()">取消</div>
        </form>
    </div>
    <!--工作经历 end-->

    <!--教育经历-->
    {{--<div class="box">--}}
        {{--<div class="title">教育经历</div>--}}
        {{--<div id="eduBox" style="display:block">--}}
            {{--<div class="button" id="eduEdit" onclick="upEdu() ">编辑</div>--}}
            {{--学校名称：<span id="school">北京大学</span>&nbsp;&nbsp;--}}
            {{--学历：<span id="degree">硕士</span><br>--}}
            {{--专业：<span id="major">网络对抗技术</span>&nbsp;&nbsp;--}}
            {{--开始时间：<span id="eduStaYear">2012</span>年--}}
            {{--结束时间：<span id="eduEndYear">2016</span>年--}}
        {{--</div>--}}

        {{--<form id="eduForm" style="display: none">--}}
            {{--<input type="text" placeholder="学校名称" id="upschool"><br>--}}
            {{--<input type="text" placeholder="专业名称" id="upmajor"><br>--}}
            {{--请选择学历：--}}
            {{--<select class="updegree" id="updegree">--}}
                {{--<option value="大专">大专</option>--}}
                {{--<option value="本科">本科</option>--}}
                {{--<option value="硕士">硕士</option>--}}
                {{--<option value="博士">博士</option>--}}
                {{--<option value="其他">其他</option>--}}
            {{--</select>&nbsp;&nbsp;&nbsp;&nbsp;--}}
            {{--开始年份：--}}
            {{--<select class="upeduStaYear" id="upeduStaYear">--}}
                {{--<option value="2017">2017</option>--}}
                {{--<option value="2016">2016</option>--}}
                {{--<option value="2015">2015</option>--}}
                {{--<option value="2014">2014</option>--}}
                {{--<option value="2013">2013</option>--}}
                {{--<option value="2012">2012</option>--}}
                {{--<option value="2011">2011</option>--}}
                {{--<option value="2010">2010</option>--}}
                {{--<option value="2009">2009</option>--}}
                {{--<option value="2008">2008</option>--}}
                {{--<option value="2007">2007</option>--}}
                {{--<option value="2006">2006</option>--}}
                {{--<option value="2005">2005</option>--}}
                {{--<option value="2004">2004</option>--}}
                {{--<option value="2002">2003</option>--}}
                {{--<option value="2001">2001</option>--}}
                {{--<option value="2000">2000</option>--}}
            {{--</select>年--}}
            {{--&nbsp;&nbsp;&nbsp;&nbsp;--}}
            {{--结束年份：--}}
            {{--<select class="upeduEndYear" id="upeduEndYear">--}}
                {{--<option value="2017">2017</option>--}}
                {{--<option value="2016">2016</option>--}}
                {{--<option value="2015">2015</option>--}}
                {{--<option value="2014">2014</option>--}}
                {{--<option value="2013">2013</option>--}}
                {{--<option value="2012">2012</option>--}}
                {{--<option value="2011">2011</option>--}}
                {{--<option value="2010">2010</option>--}}
                {{--<option value="2009">2009</option>--}}
                {{--<option value="2008">2008</option>--}}
                {{--<option value="2007">2007</option>--}}
                {{--<option value="2006">2006</option>--}}
                {{--<option value="2005">2005</option>--}}
                {{--<option value="2004">2004</option>--}}
                {{--<option value="2002">2003</option>--}}
                {{--<option value="2001">2001</option>--}}
                {{--<option value="2000">2000</option>--}}
            {{--</select>年<br>--}}
            {{--<div class="subbutton" id="eduSava" onclick="saveEdu()">保存</div>--}}
            {{--<div class="subbutton" id="eduQuit" onclick="quitEdu()">取消</div>--}}
        {{--</form>--}}
    {{--</div>--}}
    <!--教育经历 end-->

    <div class="upload_resume" id="upload_resume" style="display: none">
        <input type="file" name="uploadFile" id="uploadFile">
        <input type="button" class="subbutton" id="uploadResume" onclick="uploadResume()" value="上传" >
        <input type="button" class="subbutton" id="uploadQuit" value="取消" onclick="uploadQuit()">
    </div>
</div>
@include('headerAndFooter.footer')
</body>
</html>
<script src="/style/js/jianli.js" type="text/javascript"></script>