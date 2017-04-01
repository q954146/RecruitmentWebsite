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

<form action="/ajax/test" method="post" id="form">
    <input type="hidden" name="_token" value="{{ csrf_token() }}"/>

    <input type="text" name="name" id="name">
    <br>
    <input type="submit" name="submit" id="submit">
</form>

<script src="https://cdn.bootcss.com/jquery/1.12.4/jquery.min.js"></script>
<script>
    $(document).ready(function () {
       $('#submit').click(function () {
           $.ajax({
               url:'http://123.207.137.43/ajax/test',
               type:"POST",
               dataType:"json",
               data:{
                   '_token':$('#_token').val(),
                   'name':$('#name').val()
               },
               headers:{
                   'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
               },
               timeout:3000,
               success:function (data) {
                   alert(data.status);
               },
               error: function(jqXHR){
                   console.log('error', jqXHR)
               }
           });
       });
    });
</script>
</body>
</html>

