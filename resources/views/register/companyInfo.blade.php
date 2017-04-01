<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>公司基本信息</title>
</head>
<body>

<form action="/register/company/info" method="post" enctype="multipart/form-data">

    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
    公司名称:<br>
    <input type="text" name="name" value="{{$name}}">
    <br>

    电话号码:<br>
    <input type="tel" name="tel" value="">
    <br>

    公司简称:<br>
    <input type="text" name="shortName" value="">
    <br>

    公司logo:<br>
    <input type="file" name="logo">
    <br>

    网址:<br>
    <input type="url" name="web" value="">
    <br>

    所在城市:<br>
    <input type="text" name="city" value="">
    <br>

    领域:<br>
    <select name="trade">
        @foreach($tradeInfos as $key =>$tradeInfo)
            <option value="{{$key}}">{{$tradeInfo}}</option>
        @endforeach
    </select>
    <br>

    规模:<br>
    <select name="scale">
        <option value="0">10-50人</option>
        <option value="1">50-100人</option>
        <option value="2">100-500人</option>
        <option value="3">500人以上</option>
    </select>
    <br>

    发展阶段:<br>
    <select name="stage">
        <option value="0">未融资</option>
        <option value="1">天使轮</option>
        <option value="2">A轮</option>
        <option value="3">B轮</option>
        <option value="4">上市公司</option>
    </select>
    <br>

    一句话介绍:<br>
    <input type="text" name="oneDesc" value="">
    <br>


    <input type="submit" name="提交">
</form>





</body>
</html>