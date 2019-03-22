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
    <link rel="stylesheet" href="{{url('layui/css/layui.css')}}">
    <link rel="stylesheet" href="{{url('layui/css/layui.css')}}">
    <link href="{{url('css/comm.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{url('css/index.css')}}" rel="stylesheet" type="text/css" />
    <script src="{{url('jquery-3.2.1.min.js')}}"></script>
    <script src="{{url('layui/layui.js')}}"></script>
    <script src="{{url('js/all.js')}}"></script>
    <script src="{{url('js/index.js')}}"></script>
    <script src="{{url('js/lazyload.min.js')}}"></script>
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
            <li class="f_single"><a href="/v41/post/index.do"  @if($type == 3)class="hover"@endif><i></i>最新揭晓</a></li>
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

