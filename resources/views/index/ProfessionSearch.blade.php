<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>职位搜索</title>
    <link href="/style/css/style.css" type="text/css" rel="stylesheet">
    <style>
        .positionBox{
            margin: 150px 200px;
            width: 680px;
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
    <ul class="reset my_collections">
        @if(count($professions)>0)
            @foreach($professions as $profession)
                <li>
                    <a title="{{$profession['name']}}" target="_blank" href="/company/show/{{$profession->user->company['id']}}">
                        <img alt="{{$profession->user->company['name']}}" src="/uploads/{{$profession->user->company['logo']}}">
                    </a>
                    <div class="co_item">
                        <h2 title="酒店业务助理">
                            <a target="_blank" href="/profession/show/{{$profession['id']}}">
                                <em>{{$profession['name']}}</em>
                                <span>（{{$profession['salaryLow']}}-{{$profession['salaryHigh']}}）</span>
                            </a>
                        </h2>
                        <span class="co_time">发布时间：{{$profession['created_at']}}</span>
                        <div class="co_cate">{{$profession->user->company['name']}} / {{$profession['city']}} / {{$profession['workYear']}}/ {{$profession['edu']}}</div>
                        <span class="co_youhuo c7">{{$profession['welfare']}}</span>
                        <input type="hidden" name="id" value="{{$profession['id']}}">
                    </div>
                </li>
            @endforeach
        @endif
    </ul>
</div>
@include('headerAndFooter.footer')
</body>
</html>