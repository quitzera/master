@extends('master')
@section('content')
	<body fnav="1" class="g-acc-bg">
	<div class="marginB" id="loadingPicBlock">
		<!--首页头部-->
		<div class="m-block-header" style="display: none">
			<div class="search"></div>
			<a href="/" class="m-public-icon m-1yyg-icon"></a>
		</div>
		<!--首页头部 end-->

		<!-- 关注微信 -->
		<div id="div_subscribe" class="app-icon-wrapper" style="display: none;">
			<div class="app-icon">
				<a href="javascript:;" class="close-icon"><i class="set-icon"></i></a>
				<a href="javascript:;" class="info-icon">
					<i class="set-icon"></i>
					<div class="info">
						<p>点击关注666潮人购官方微信^_^</p>
					</div>
				</a>
			</div>
		</div>

		<!-- 焦点图 -->
        <div class="hotimg-wrapper">
            <div class="hotimg-top"></div>
            <section id="sliderBox" class="hotimg">
        		<ul class="slides" style="width: 600%; transition-duration: 0.4s; transform: translate3d(-828px, 0px, 0px);">
        			<li style="width: 414px; float: left; display: block;" class="clone">
        				<a href="http://weixin.1yyg.com/v27/products/23559.do?pf=weixin">
        					<img src="https://ss2.bdstatic.com/70cFvnSh_Q1YnxGkpoWK1HF6hhy/it/u=3126854174,2746990258&fm=27&gp=0.jpg" alt="">
        				</a>
        			</li>
        			<li class="" style="width: 414px; float: left; display: block;">
        				<a href="http://weixin.1yyg.com/v40/GoodsSearch.do?q=%E5%B0%8F%E7%B1%B36&amp;pf=weixin">
        					<img src="https://ss3.bdstatic.com/70cFv8Sh_Q1YnxGkpoWK1HF6hhy/it/u=3240052967,3443336204&fm=27&gp=0.jpg" alt="">
        				</a>
        			</li>
        			<li style="width: 414px; float: left; display: block;" class="flex-active-slide">
        				<a href="http://weixin.1yyg.com/v40/GoodsSearch.do?q=%E6%B8%85%E5%87%89%E4%B8%80%E5%A4%8F&amp;pf=weixin"><img src="https://ss1.bdstatic.com/70cFvXSh_Q1YnxGkpoWK1HF6hhy/it/u=2735633715,2749454924&fm=27&gp=0.jpg" alt="">
        				</a>
        			</li>
        			<li style="width: 414px; float: left; display: block;" class="">
        				<a href="http://weixin.1yyg.com/v40/GoodsSearch.do?q=%E6%96%B0%E9%B2%9C%E6%B0%B4%E6%9E%9C&amp;pf=weixin"><img src="https://ss0.bdstatic.com/6Ox1bjeh1BF3odCf/it/u=3660968530,985748925&fm=191&app=48&size=h300&n=0&g=4n&f=JPEG?sec=1853310920&t=5e64af964be378c6c2a3b0acc65dfe24" alt=""></a>
        			</li>
        			<li style="width: 414px; float: left; display: block;" class="">
        				<a href="http://weixin.1yyg.com/v27/products/23559.do?pf=weixin">
        					<img src="https://ss2.bdstatic.com/70cFvnSh_Q1YnxGkpoWK1HF6hhy/it/u=2323965838,1386432598&fm=27&gp=0.jpg" alt="">
        				</a>
        			</li>
        			<li class="clone" style="width: 414px; float: left; display: block;">
        				<a href="http://weixin.1yyg.com/v40/GoodsSearch.do?q=%E5%B0%8F%E7%B1%B36&amp;pf=weixin">
        					<img src="https://ss3.bdstatic.com/70cFv8Sh_Q1YnxGkpoWK1HF6hhy/it/u=2042081257,3286878324&fm=27&gp=0.jpg" alt="">
        				</a>
        			</li>
        		</ul>
            </section>
        </div>
         <script src="http://cdn.bootcss.com/flexslider/2.6.2/jquery.flexslider.min.js"></script>
        <script>
        	$(function () {  
        		$('.hotimg').flexslider({   
        			directionNav: false,   //是否显示左右控制按钮   
        			controlNav: true,   //是否显示底部切换按钮   
        			pauseOnAction: false,  //手动切换后是否继续自动轮播,继续(false),停止(true),默认true   
        			animation: 'slide',   //淡入淡出(fade)或滑动(slide),默认fade
        			slideshowSpeed: 3000,  //自动轮播间隔时间(毫秒),默认5000ms
        			animationSpeed: 150,   //轮播效果切换时间,默认600ms   
        			direction: 'horizontal',  //设置滑动方向:左右horizontal或者上下vertical,需设置animation: "slide",默认horizontal   
        			randomize: false,   //是否随机幻切换   
        			animationLoop: true   //是否循环滚动  
        		});  
        		setTimeout($('.flexslider img').fadeIn()); 
        	}); 
        </script>
        <!--分类-->
        <div class="index-menu thin-bor-top thin-bor-bottom">
            <ul class="menu-list">
                <li>
                    <a href="{{url('all')}}" id="btnNew">
                        <i class="xinpin"></i>
                        <span class="title">新品</span>
                    </a>
                </li>
                <li>
                    <a href="javascript:;" id="btnRecharge">
                        <i class="chongzhi"></i>
                        <span class="title">充值</span>
                    </a>
                </li>
                <li>
                    <a href="javascript:;" id="btnLimitbuy">
                        <i class="contact"></i>
                        <span class="title">联系我们</span>
                    </a>
                </li>
                <li>
                    <a href="javascript:;" id="btnDownApp">
                        <i class="xiazai"></i>
                        <span class="title">下载APP</span>
                    </a>
                </li>
                <li>
                    <a href="/share" id="btnAllGoods">
                        <i class="fenlei"></i>
                        <span class="title">晒单</span>
                    </a>
                </li>
            </ul>
        </div>
        <!--导航-->
		<button class="weui-btn weui-btn_plain-primary" id="onMenuShareAppMessage">我的位置</button>
        <div class="success-tip">
        	<div class="left-icon"></div>
        	<ul class="right-con">
				<li>
					<span style="color: #4E555E;" target="_blank">
						<a href="/code" style="color: #4E555E;">&nbsp;&nbsp;&nbsp;扫码关注</a>
					</span>
				</li>
			</ul>
        </div>

        <!-- 热门推荐 -->
        <div class="line hot">
        	<div class="hot-content">
        		<i></i>
        		<span>最新商品</span>
        		<div class="l-left"></div>
        		<div class="l-right"></div>
        	</div>
        </div>
        <div class="hot-wrapper">
        	<ul class="clearfix">
                @foreach($data as $v)
        		<li style="border-right:1px solid #e4e4e4; ">
        			<a href="/detail/{{$v->goods_id}}">
        				<p class="title">{{$v->goods_name}}</p>
        				<p class="subtitle">￥{{$v->self_price}}</p>
        				<img src="/uploads/{{$v->goods_img}}" alt="">
        			</a>
        		</li>
                @endforeach
        	</ul>
        </div>
        <!-- 猜你喜欢 -->
        <div class="line guess">
        	<div class="hot-content">
        		<i></i>
        		<span>猜你喜欢</span>
        		<div class="l-left"></div>
        		<div class="l-right"></div>
        	</div>
        </div>
        <!--商品列表-->
        <div class="goods-wrap marginB">
            <ul id="ulGoodsList" class="goods-list clearfix">
				@foreach($hot as $v)
            	<li id="23558" codeid="12751965" goods_id="{{$v->goods_id}}" codeperiod="28436">
            		<a href="detail/{{$v->goods_id}}" class="g-pic">
            			<img class="lazy" name="goodsImg" data-original="/uploads/{{$v->goods_img}}" width="136" height="136">
            		</a>
            		<p class="g-name">{{$v->goods_name}}</p>
            		<ins class="gray9">价值：￥{{$v->self_price}}</ins>
            		<div class="Progress-bar">
            			<p class="u-progress">
            				<span class="pgbar" style="width: 96.43076923076923%;">
            					<span class="pging"></span>
            				</span>
            			</p>

            		</div>
            		<div class="btn-wrap" name="buyBox" limitbuy="0" surplus="58" totalnum="1625" alreadybuy="1567">
            			<a href="javascript:;" class="buy-btn" codeid="12751965">立即潮购</a>
            			<div class="gRate intoCart" codeid="12751965" canbuy="58">
            				<a href="javascript:;"></a>
            			</div>
            		</div>
            	</li>
				@endforeach
            </ul>
            <div class="loading clearfix"><b></b>正在加载</div>
		</div>
		<script>
			wx.ready(function () {   //需在用户可能点击分享按钮前就先调用
				$("#onMenuShareAppMessage").click(function () {
					wx.getLocation({
						type: 'wgs84', // 默认为wgs84的gps坐标，如果要返回直接给openLocation用的火星坐标，可传入'gcj02'
						success: function (res) {
							var latitude = res.latitude; // 纬度，浮点数，范围为90 ~ -90
							var longitude = res.longitude; // 经度，浮点数，范围为180 ~ -180。
							var speed = res.speed; // 速度，以米/每秒计
							var accuracy = res.accuracy; // 位置精度
						}
					});
					// wx.updateAppMessageShareData({
					// 	title: 'Wdnmd', // 分享标题
					// 	desc: 'Mr.Wdnmd', // 分享描述
					// 	link: document.URL, // 分享链接，该链接域名或路径必须与当前页面对应的公众号JS安全域名一致
					// 	imgUrl: 'http://39.107.86.183/uploads/20190411/3893.jpg', // 分享图标
					// 	success: function () {
					// 		// 设置成功
					// 		alert('分享成功')
					// 	}
					// })
				})
				wx.updateAppMessageShareData({
					title: '', // 分享标题
					desc: '', // 分享描述
					link: '', // 分享链接，该链接域名或路径必须与当前页面对应的公众号JS安全域名一致
					imgUrl: '', // 分享图标
					success: function () {
						// 设置成功
					}
				})
			});
			$(".m-block-header").hide();
			$(function(){
				$('#fuck').attr('href','');
				$(document).on('click','.intoCart',function(){
					var goods_id = $(this).parents('li').attr('goods_id');
					$.post(
							"/intoCart"
							,{goods_id,goods_id}
							,function(res){
								console.log(res)
							}
					)
				})
			})

		</script>
@endsection