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


<fieldset style="float: left;margin-top: 100px">
    <legend>管理登录：</legend>
    <form action="/admin/login" id="manaLogin" name="manaLogin" method="post">
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        <label>账号:<input type="text" name="username"></label><br>
        <label>密码:<input type="password" name="password"></label>
        <br>
        <input class="submit" type="submit" value="登录">
    </form>
</fieldset>

</body>
</html>