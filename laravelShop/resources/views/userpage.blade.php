@extends('master')
@section('content')
    <link href="css/comm.css" rel="stylesheet" type="text/css" /><link href="{{url('css/member.css')}}" rel="stylesheet" type="text/css" /><script src="js/jquery190_1.js" language="javascript" type="text/javascript"></script>

<body class="g-acc-bg">
    @if(!$info)
    <div class="welcome">
        <p>Hi，等你好久了！</p>
        <a href="/login" class="orange">登录</a>
        <a href="/register" class="orange">注册</a>
    </div>
    @else
    <div class="welcome">
        <a href="{{url('set')}}"><i class="set"></i></a>
        <div class="login-img clearfix">
            <ul>
                <li><img src="https://ss2.bdstatic.com/70cFvnSh_Q1YnxGkpoWK1HF6hhy/it/u=3126854174,2746990258&fm=27&gp=0.jpg" alt=""></li>
                <li class="name">
                    <h4>{{$info->user_email}}</h4>
                    <p>ID：{{$info->user_id}}</p>
                </li>
                <li class="next fr"><s></s></li>
            </ul>
        </div>
        <div class="chao-money">
            <ul class="clearfix">
                <li class="br">
                    <p>潮购值</p>
                    <span>822</span>
                </li>
                <li class="br">
                    <p>余额（元）</p>
                    <span>0</span>
                </li>
                <li>
                    <a href="" class="recharge">去充值</a>
                </li>
            </ul>
        </div>

    </div>
    @endif
    <!--获得的商品-->
    
    <!--导航菜单-->
    
    <div class="sub_nav marginB person-page-menu">
        <a href="{{url('buyRecord')}}"><s class="m_s1"></s>潮购记录<i></i></a>
        <a href="/v44/member/orderlist.do"><s class="m_s2"></s>获得的商品<i></i></a>
        <a href="/v44/member/postlist.do"><s class="m_s3"></s>我的晒单<i></i></a>
        <a href="/v44/member/mywallet.do"><s class="m_s4"></s>我的钱包<i></i></a>
        <a href="{{url('/address')}}"><s class="m_s5"></s>收货地址<i></i></a>
        <a href="/v44/help/help.do" class="mt10"><s class="m_s6"></s>帮助与反馈<i></i></a>
        <a href="/v44/help/help.do"><s class="m_s7"></s>二维码分享<i></i></a>
        <p class="colorbbb">客服热线：400-666-2110  (工作时间9:00-17:00)</p>
    </div>


    <script>
        function goClick(obj, href) {
            $(obj).empty();
            location.href = href;
        }
        if (navigator.userAgent.toLowerCase().match(/MicroMessenger/i) != "micromessenger") {
            $(".m-block-header").show();
        }

        $(".m-block-header").hide();

    </script>
</body>
    @endsection

