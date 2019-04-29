<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>救救孩子！</title>
    <meta content="app-id=518966501" name="apple-itunes-app" />
    <meta content="width=device-width,initial-scale=1.0,maximum-scale=1.0,minimum-scale=1.0,user-scalable=no" name="viewport" />
    <meta content="yes" name="apple-mobile-web-app-capable" />
    <meta content="black" name="apple-mobile-web-app-status-bar-style" />
    <meta content="telephone=no" name="format-detection" />
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="0" />
    <link id='fuck' rel="stylesheet" href="css/mui.min_1.css">
    <link rel="stylesheet" href="{{url('layui/layui/css/layui.css')}}">
    <link rel="stylesheet" href="{{url('layui/layui/css/layui.css')}}">
    <link rel="stylesheet" href="{{url('weui-master/dist/style/weui.min.css')}}">
    <link href="{{url('css/comm.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{url('css/index.css')}}" rel="stylesheet" type="text/css" />
    <script src="{{url('jquery-3.2.1.min.js')}}"></script>
    <script src="{{url('layui/layui/layui.js')}}"></script>
    <script src="{{url('js/all.js')}}"></script>
    <script src="{{url('js/index.js')}}"></script>
    <script src="{{url('js/lazyload.min.js')}}"></script>
    <script src="http://res2.wx.qq.com/open/js/jweixin-1.4.0.js"></script>
</head>
<div class="m-block-header" id="div-header">
    <strong id="m-title"></strong>
    <a href="javascript:history.back();" class="m-back-arrow"><i class="m-public-icon"></i></a>
    <a href="/" class="m-index-icon"><i class="home-icon"></i></a>
</div>

@yield('content')
</div>
<!--底部-->
    <div class="footer clearfix">
        <ul>
            <li class="f_home"><a href="/" @if($type == 1)class="hover"@endif><i></i>潮购</a></li>
            <li class="f_announced"><a href="{{url('all')}}"  @if($type == 2)class="hover"@endif><i></i>所有商品</a></li>
            <li class="f_single"><a href="{{url('share')}}"  @if($type == 3)class="hover"@endif><i></i>最新揭晓</a></li>
            <li class="f_car"><a id="btnCart" href="{{url('cart')}}"  @if($type == 4)class="hover"@endif><i></i>购物车</a></li>
            <li class="f_personal"><a href="{{url('user')}}"  @if($type == 5)class="hover"@endif><i></i>我的潮购</a></li>
        </ul>
    </div>
    <div id="div_fastnav" class="fast-nav-wrapper">
        <ul class="fast-nav">
            <li id="li_menu" isshow="0">
                <a href="javascript:;"><i class="nav-menu"></i></a>
            </li>
            <li id="li_top" style="display: none;">
                <a href="javascript:;"><i class="nav-top"></i></a>
            </li>
        </ul>
        <div class="sub-nav four" style="display: none;">
            <a href="#"><i class="announced"></i>最新揭晓</a>
            <a href="#"><i class="single"></i>晒单</a>
            <a href="#"><i class="personal"></i>我的潮购</a>
            <a href="#"><i class="shopcar"></i>购物车</a>
        </div>
    </div>

    <script>

        jQuery(document).ready(function() {
            $("img.lazy").lazyload({
                placeholder : "images/loading2.gif",
                effect: "fadeIn",
            });
            {{--wx.config({--}}
                {{--debug: false,--}}
                {{--appId: "{{$signPackage['appId']}}",--}}
                {{--timestamp: "{{$signPackage['timestamp']}}",--}}
                {{--nonceStr: "{{$signPackage['nonceStr']}}",--}}
                {{--signature: "{{$signPackage['signature']}}",--}}
                {{--jsApiList: [--}}
                    {{--// 所有要调用的 API 都要加到这个列表中--}}
                    {{--'updateTimelineShareData'--}}
                    {{--,'onMenuShareWeibo'--}}
                    {{--,'updateAppMessageShareData'--}}
                    {{--,'getLocation'--}}
                    {{--,'openLocation'--}}
                    {{--,'onMenuShareTimeline'--}}
                {{--]--}}
            {{--});--}}
            {{--wx.ready(function () {--}}
                {{--wx.onMenuShareWeibo({--}}
                    {{--title: '我的微商城', // 分享标题--}}
                    {{--desc: '嘿嘿嘿', // 分享描述--}}
                    {{--link: document.URL, // 分享链接--}}
                    {{--imgUrl: 'http://39.107.86.183/uploads/20190416/9983.jpg', // 分享图标--}}
                    {{--success: function () {--}}
                    {{--},--}}
                    {{--cancel: function () {--}}
{{--// 用户取消分享后执行的回调函数--}}
                    {{--}--}}
                {{--});--}}
                {{--wx.updateAppMessageShareData({--}}
                    {{--title: '我的微商城', // 分享标题--}}
                    {{--desc: '嘿嘿嘿', // 分享描述--}}
                    {{--link: document.URL, // 分享链接，该链接域名或路径必须与当前页面对应的公众号JS安全域名一致--}}
                    {{--imgUrl: 'http://39.107.86.183/uploads/20190416/9983.jpg', // 分享图标--}}
                    {{--success: function () {--}}
                    {{--}--}}
                {{--})--}}
                {{--wx.getLocation({--}}
                    {{--type: 'wgs84', // 默认为wgs84的gps坐标，如果要返回直接给openLocation用的火星坐标，可传入'gcj02'--}}
                    {{--success: function (res) {--}}
                        {{--var latitude = res.latitude; // 纬度，浮点数，范围为90 ~ -90--}}
                        {{--var longitude = res.longitude; // 经度，浮点数，范围为180 ~ -180。--}}
                        {{--var speed = res.speed; // 速度，以米/每秒计--}}
                        {{--var accuracy = res.accuracy; // 位置精度--}}
                        {{--wx.openLocation({--}}
                            {{--latitude: latitude, // 纬度，浮点数，范围为90 ~ -90--}}
                            {{--longitude: longitude, // 经度，浮点数，范围为180 ~ -180。--}}
                            {{--name: '您的位置', // 位置名--}}
                            {{--address: '在这儿呢', // 地址详情说明--}}
                            {{--scale: 20, // 地图缩放级别,整形值,范围从1~28。默认为最大--}}
                            {{--infoUrl: '#' // 在查看位置界面底部显示的超链接,可点击跳转--}}
                        {{--});--}}
                    {{--}--}}
                {{--});--}}
                {{--wx.onMenuShareTimeline({--}}
                    {{--title: '我的微商城', // 分享标题--}}
                    {{--link: document.URL, // 分享链接，该链接域名或路径必须与当前页面对应的公众号JS安全域名一致--}}
                    {{--imgUrl: 'http://39.107.86.183/uploads/20190416/9983.jpg', // 分享图标--}}
                    {{--success: function () {--}}
                        {{--// 用户点击了分享后执行的回调函数--}}
                    {{--}--}}
                {{--})--}}
            {{--});--}}
            // 返回顶部点击事件
            $('#div_fastnav #li_menu').click(
                function(){
                    if($('.sub-nav').css('display')=='none'){
                        $('.sub-nav').css('display','block');
                    }else{
                        $('.sub-nav').css('display','none');
                    }
                }
            )
            $("#li_top").click(function(){
                $('html,body').animate({scrollTop:0},300);
                return false;
            });

            $(window).scroll(function(){
                if($(window).scrollTop()>200){
                    $('#li_top').css('display','block');
                }else{
                    $('#li_top').css('display','none');
                }

            })
        });

    </script>
</body>
</html>

