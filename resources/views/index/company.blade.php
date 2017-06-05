@extends('index.companyBase')
@section('left')

    <div id="container_left">

        <div class="item_container" id="company_products">
            <div class="item_ltitle">公司产品</div>
            @if(count($products) >0)
                @foreach($products as $product)
                    <div class="item_content">
                        <div class="product_content product_item clearfix" data-id="8645" data-index="0">
                            <img src="/uploads/{{$product['image']}}" alt="产品图片" width="300" height="180">
                            <div class="product_details">
                                <h4 class="product_url_all">
                                    <div class="product_url">
                                        <a href="{{$product['link']}}" class="url_valid" target="_blank" rel="nofollow" title="http://www.chelaile.net.cn">
                                            {{$product['name']}}
                                        </a>
                                        <a href="{{$product['link']}}" target="_blank" rel="nofollow" title="{{$product['link']}}">
                                            <i></i>
                                        </a>
                                    </div>
                                </h4>
                                {{--<ul class="clearfix">--}}
                                {{--<li>{{$product['position']}}</li>--}}
                                {{--</ul>--}}
                                <div class="product_profile mCustomScrollbar _mCS_1">
                                    <div class="mCustomScrollBox mCS-dark-2" id="mCSB_1" style="position:relative; height:100%; overflow:hidden; max-width:100%;">
                                        <div class="mCSB_container" style="position: relative; top: -22px;">
                                            {{$product['desc']}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>


        <div class="item_container" id="company_intro">
            <div class="item_ltitle">公司介绍</div>
            <div class="item_content">
                <div class="company_intro_text" style="display: block;">
            <span class="company_content">
            {{$company['desc']}}
            </span>
                </div>

                <div class="company_image_gallery">
                </div>
            </div>
        </div>

    </div>

@endsection