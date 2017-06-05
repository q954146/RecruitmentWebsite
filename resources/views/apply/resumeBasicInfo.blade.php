<!DOCTYPE HTML>
<html>
<head>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type">
    <title>传媒之家-最专业的传媒领域招聘平台</title>
    <link rel="stylesheet" type="text/css" href="/style/css/style.css"/>
    <script type="text/javascript" src="/style/js/jquery.1.10.1.min.js"></script>

</head>
<body>

<div id="body">
    @include('headerAndFooter.headerType1Login')
    <br><br>
    <div id="container">
        <div class="content_mid">

            <form class="corp_form" id="bindForm" method="post" action="/register/company">

                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">

                <input type="text" value="" placeholder="" name="name" >

                <input type="text" value="" placeholder="" name="email">

                <input type="text" value="" placeholder="" name="sex" >

                <input type="text" value="" placeholder="" name="education">

                <input type="text" value="" placeholder="" name="workYear">

                <input type="text" value="" placeholder="" name="phone">

                <input type="text" value="" placeholder="" name="city" >

                <input type="text" value="" placeholder="" name="image" >

                <input type="text" value="" placeholder="" name="introduction" >

                <input type="text" value="" placeholder="" name="state">

                <input type="submit" value="提交" id="bindSubmit">
            </form>


        </div>
    </div>
</div><!-- end #body -->
@include('headerAndFooter.footer')

</body>
</html>