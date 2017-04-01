<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>register</title>
</head>
<body>

<form action="/register/company" method="post">

    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
     公司名称:<br>
    <input type="text" name="name">
    <br>
    电子邮件:<br>
    <input type="email" name="email">

    <input type="submit" name="提交">
</form>

</body>
</html>