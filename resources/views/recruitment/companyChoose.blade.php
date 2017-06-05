<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>公司选择</title>
</head>
<body>

你好 {{$user->name}}
<br>
<a> 从原有公司中选择一个</a>

<form action="/company/choose" method="post">

    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">

    公司名称:<br>
    <select name="id">
        @foreach($companies as $company)
            <option value="{{$company['id']}}">{{$company['name']}}</option>
        @endforeach
    </select>

    <input type="submit" name="确定">
</form>

@include('errors.formError')

<a href="/register/company">注册一个新的公司</a>

</body>
</html>