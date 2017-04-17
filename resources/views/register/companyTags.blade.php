<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ajaxTest</title>
    {{--<link href="css/bootstrap.min.css" rel="stylesheet">--}}
    <meta name="csrf_token" content="{{ csrf_token() }}">
</head>
<body>

<form action="/register/company/tag" method="post" id="form">
    <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}"/>

    <div id="show">
    </div>

    标签名称:<br>
    <input id="newTag" type="text" name="customize">
    <br>
    <input id='ok' type="button" value="确定">

    <br>
    薪酬激励:<br>
    @foreach($tags1 as $key =>$tag1)
    <p><input type="checkbox" name="tag" value="{{$tag1['id']}}" />{{$tag1['name']}}</p>
    @endforeach
    <br>

    员工福利:<br>
    @foreach($tags2 as $key =>$tag2)
    <p><input type="checkbox" name="tag" value="{{$tag2['id']}}" />{{$tag2['name']}}</p>
    @endforeach
    <br>

    员工关怀:<br>
    @foreach($tags3 as $key =>$tag3)
    <p><input type="checkbox" name="tag" value="{{$tag3['id']}}" />{{$tag3['name']}}</p>
    @endforeach
    <br>

    其他:<br>
    @foreach($tags4 as $key =>$tag4)
    <p><input type="checkbox" name="tag" value="{{$tag4['id']}}" />{{$tag4['name']}}</p>
    @endforeach
    <br>
    <input type="submit" name="submit" id="submit">

</form>

{{--<script src="https://cdn.bootcss.com/jquery/1.12.4/jquery.min.js"></script>--}}


</body>
</html>
