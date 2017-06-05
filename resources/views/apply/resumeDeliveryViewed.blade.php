@extends('apply.resumeDeliveryBase')


@section('delivery')

    @if(count($sends)>0)
        @foreach($sends as $send)
            <ul class="reset my_delivery">
                <li>
                    <div class="d_item">
                        <h2 title="{{$send['profession']['name']}}">
                            <a target="_blank" href="/profession/show/{{$send['profession']['id']}}">
                                <em>{{$send['profession']['name']}}</em>
                                <span>（{{$send['profession']['salaryLow']}}-{{$send['profession']['salaryHigh']}}）</span>
                            </a>
                        </h2>
                        <div class="clear"></div>
                        <a title="{{$send['company']['name']}}" class="d_jobname" target="_blank" href="/company/show/{{$send['company']['id']}}">
                            {{$send['company']['name']}} <span>[{{$send['company']['city']}}]</span>
                        </a>
                        <span class="d_time">{{$send['viewedTime']}}</span>
                        <div class="clear"></div>
                        <div class="d_resume">
                            使用简历：
                            <span>
                                {{$send['sendType']}}
                            </span>
                        </div>
                        <a class="btn_showprogress">
                            被查看
                        </a>
                    </div>
                </li>
            </ul>
        @endforeach
    @endif


@endsection