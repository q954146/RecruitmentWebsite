<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>管理登录</title>
    <link href="/style/css/style.css" type="text/css" rel="stylesheet">
    <link href="/style/css/style2.css" type="text/css" rel="stylesheet">
    <script type="text/javascript" src="/style/js/jquery.1.10.1.min.js"></script>
</head>
<body>
<div id="header">
    <div class="wrapper">
        <a class="logo" href="h/"><img width="229" height="130" alt="传媒之家招聘-专注传媒领域招聘" src="style/images/logo.png"></a>
        <ul id="navheader" class="reset">
            <li><a href="index.html">首页</a></li>
            <li class="current"><a href="h/c/companylist.html">公司</a></li>
            <li><a href="h/toForum.html" target="_blank">论坛</a></li>
            <li>
                <a rel="nofollow" href="positions.html">简历管理</a>
            </li>
            <li><a rel="nofollow" href="create.html">发布职位</a></li>
        </ul>
    </div>
</div><!-- end #header -->
<fieldset style="float: left;margin-top: 100px">
    <legend>管理登录：</legend>
    <form action="" id="manaLogin" name="manaLogin" method="post">
        <label>账号:<input type="text" name="account"></label><br>
        <label>密码:<input type="password" name="psw"></label>
        <br>
        <input class="submit" type="submit" value="登录">
    </form>
</fieldset>

@include('headerAndFooter.footer')
</body>
</html>