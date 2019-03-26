@extends('master')
@section('content')
    <link href="css/comm.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="css/buyrecord.css">
   
    
</head>
<body>
    
<!--触屏版内页头部-->

@if($data)
<div class="recordwrapp">
    @foreach($data as $v)
    <div class="buyrecord-con clearfix">
        <div class="record-img fl">
            <img src="/uploads/{{$v->goods_img}}" alt="">
        </div>
        <div class="record-con fl">
            <h3>{{$v->goods_name}}</h3>
            <p class="winner">获得者：<i>{{$v->user_email}}</i></p>
            <p class="winner">价格：<i>￥{{$v->self_price}}</i></p>
            <p class="winner">数量：<i>{{$v->buy_num}}</i></p>
            <div class="clearfix">
                <div class="win-wrapp fl">
                    <p class="w-time">{{$v->created_at}}</p>
                </div>
                <div class="fr"><i class="buycart"></i></div>
            </div>
        </div>
    </div>
@endforeach
</div>
@else
<div class="nocontent">
    <div class="m_buylist m_get">
        <ul id="ul_list">
            <div class="noRecords colorbbb clearfix">
                <s class="default"></s>您还没有购买商品哦~
            </div>
            <div class="hot-recom">
                <div class="title thin-bor-top gray6">
                    <span><b class="z-set"></b>人气推荐</span>
                    <em></em>
                </div>
                <div class="goods-wrap thin-bor-top">
                    <ul class="goods-list clearfix">
                        @foreach($beta as $v)
                        <li>
                            <a href="/detail/{{$v->goods_id}}" class="g-pic">
                                <img src="/uploads/{{$v->goods_img}}" width="136" height="136">
                            </a>
                            <p class="g-name">
                                <a href="https://m.1yyg.com/v44/products/23458.do">{{$v->goods_name}}</a>
                            </p>
                            <ins class="gray9">价值:{{$v->self_price}}</ins>
                            <div class="btn-wrap">
                                <div class="Progress-bar">
                                    <p class="u-progress">
                                        <span class="pgbar" style="width:1%;">
                                            <span class="pging"></span>
                                        </span>
                                    </p>
                                </div>
                                <div class="gRate" data-productid="23458">
                                    <a href="javascript:;"><s></s></a>
                                </div>
                            </div>
                        </li>
                       @endforeach
                    </ul>
                </div>
            </div>
        </ul>
    </div>
</div>
@endif


<script src="js/jquery-1.11.2.min.js"></script>




</body>
@endsection
