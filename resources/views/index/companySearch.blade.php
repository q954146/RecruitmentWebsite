<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>职位搜索</title>
    <link href="/style/css/style.css" type="text/css" rel="stylesheet">
    <style>
        .positionBox{
            width: 70%;
            margin: 0 auto;
            margin-top: 150px;
            margin-bottom: 100px;
            background: #f3f3f3;
            padding: 20px;
        }
    </style>
</head>
<body>


@if($user == null)
    @include('headerAndFooter.headerNotLogin')
@endif

@if($user != null)
    @if($user['type'] == 1)
        @include('headerAndFooter.headerType1Login')
    @endif

    @if($user['type'] == 0)
        @include('headerAndFooter.headerType0Login')
    @endif
@endif

<div class="positionBox">
    <ul class="hc_list reset" style="width: 100%">
        @if($companies != null)
        @foreach($companies as $company)
            <li>
                <a href="/company/show/{{$company['id']}}" target="_blank">
                    <h3 title="{{$company['name']}}">{{$company['name']}}</h3>
                    <div class="comLogo">
                        <img src="/uploads/{{$company['logo']}}" width="190" height="190" alt="{{$company['name']}}" />
                        <ul>
                            <li>{{$company->trade['name']}}</li>
                            <li>{{$company['city']}}，{{$company['stage']}}</li>
                        </ul>
                    </div>
                </a>
                <ul class="reset ctags">
                    <li>{{$company['scale']}}</li>
                    @foreach($company->tags as $tag)
                        <li>{{$tag['name']}}</li>
                    @endforeach
                </ul>
            </li>
        @endforeach
        @endif

    </ul>

</div>

@include('headerAndFooter.footer')
</body>
</html>