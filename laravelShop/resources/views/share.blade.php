@extends('master')
@section('contnet')
    <link rel="stylesheet" href="css/sm.css">
    <link href="css/comm.css" rel="stylesheet" type="text/css" />
    <link href="css/single.css" rel="stylesheet" type="text/css" />
    
</head>
<body fnav="1" class="g-acc-bg">
    <div class="page-group">
        <div id="page-infinite-scroll-bottom" class="page">
            <!--导航-->
            <div class="column-wrapper">
                <div class="column-inner">
                    <!--首页头部-->
                    <div class="show"><a href="javascript:;" class=""><i></i>晒单</a></div>
                </div>
            </div>
            <!--列表内容-->
            <div id="loadingPicBlock" class="wx-show-wrapper">
                <div class="wx-show-inner">
                    <div id="divPostList" class="marginB">
                        <div class="show-list" postid="421452">
                            @if($data)
                            @foreach($data as $v)
                            <div class="show-head">
                                <a href="https://ss2.bdstatic.com/70cFvnSh_Q1YnxGkpoWK1HF6hhy/it/u=3126854174,2746990258&fm=27&gp=0.jpg" class="show-u blue"></a>
                                <span>{{$v->created_at.'分钟前'}}</span>
                            </div>
                            <a href="/uploads/{{$v->goods_img}}">
                                <h3>{{$v->goods_name}}</h3>
                            </a>
                            <a href="script:;">
                                <div class="show-pic">
                                    <ul class="pic-more clearfix">
                                        @foreach($v->goods_imgs as $vv)
                                        <li>
                                            <img src="/uploads/{{$vv}}">
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="show-con">
                                    <p>{{$v->user_email}}</p>
                                    <p name="content">我哭了，你呢？</p>
                                </div>
                            </a>
                                <hr>
                        @endforeach
                        </div>
                    </div>
                    <!-- 无内容时显示 -->
                    @else
                    <div class="noRecords colorbbb shownocontent" style="display: none">
                        <s class="default"></s>
                        暂时还没有晒单信息哦~
                    </div>
                        @endif
                </div>
            </div>

        </div>
    </div>
<script src="js/timeago.min.js"></script>
<script src="js/zepto.js" charset="utf-8"></script>
<script src="js/sm.js"></script>
<script src="js/share.js"></script>
<script>
    if($('#divPostList').children().length==0){
        $('.noRecords').css('display','block');
    }
</script>
</body>

