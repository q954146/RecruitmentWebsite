<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>申请管理</title>
    <link href="/style/css/style.css" type="text/css" rel="stylesheet">
    <link href="/style/css/style2.css" type="text/css" rel="stylesheet">
    <script type="text/javascript" src="/style/js/jquery.1.10.1.min.js"></script>
</head>
<body>

<div>
    <table cellspacing="0" cellpadding="0">
        <thead>
        <td>公司名</td>
        <td>申请人</td>
        <td>图片</td>
        <td>操作</td>
        </thead>

        @if($checks != null)
            @foreach($checks as $check)
                <div id="judge" style="display: none">{{$check->user['id']}}</div>
                <tr>
                    <td>{{$check->user->company['name']}}</td>
                    <td>{{$check->user['name']}}</td>
                    <td>查看图片<a href="/uploads/{{$check['picture']}}">（点击查看图片）</a></td>
                    @if($check['state'] == 0)
                    <td>
                        <button id="agree" onclick="agree()">同意</button>
                        <button id="disagree" onclick="disagree()">不同意</button>
                    </td>
                    @endif
                    @if($check['state'] == 1)
                        <td >
                            认证通过
                        </td>
                    @endif
                    @if($check['state'] == -1)
                        <td >
                            认证未通过
                        </td>
                    @endif
                </tr>
            @endforeach
        @endif
    </table>
</div>
</body>
</html>

<script>

    var user_id = $("#judge").html();
    function agree() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "POST",
            data: {
                user_id:user_id,
                agree:1
            },
            url:"/admin/manage"
        }).done(function (a) {
            console.info(a.flag);
//            a.flag==true ? $("#companyExamine_Form").html("<p class='succeed'>上传已成功，谢谢配合</p>") : alert('error');
        })
    }

    function disagree() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "POST",
            data: {
                user_id:user_id,
                agree:0
            },
            url:"/admin/manage"
        }).done(function (a) {
            console.info(a.flag);
//            a.flag==true ? $("#companyExamine_Form").html("<p class='succeed'>上传已成功，谢谢配合</p>") : alert('error');
        })
    }

</script>