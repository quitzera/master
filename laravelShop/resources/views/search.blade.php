

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width,initial-scale=1.0,maximum-scale=1.0,minimum-scale=1.0,user-scalable=no" name="viewport" />
    <meta content="yes" name="apple-mobile-web-app-capable" />
    <meta content="black" name="apple-mobile-web-app-status-bar-style" />
    <meta content="telephone=no" name="format-detection" />
    <title>搜索</title>

    <link href="css/comm.css" rel="stylesheet" type="text/css" />
    <link href="css/goods.css" rel="stylesheet" type="text/css" />
</head>
<body class="g-acc-bg m-site-box" fnav="2">
    <input name="hidSearchKey" type="hidden" id="hidSearchKey" value="黄金" />
    
<!--触屏版内页头部-->
<div class="m-block-header" id="div-header" style="display: block">
    <strong id="m-title">搜索</strong>
    <a href="javascript:history.back();" class="m-back-arrow"><i class="m-public-icon"></i></a>
    <a href="/" class="m-index-icon"><i class="m-public-icon"></i></a>
</div>

    <div class="pro-s-box thin-bor-bottom search-box pos-fix-0" id="divSearch">    
        <div class="box">
            <div class="border">
                <div class="border-inner"></div>
            </div>
            <div class="input-box">
                <i class="s-icon"></i>
                <input type="text" placeholder="输入“汽车”试试" value="" id="txtSearch" maxlength="10" />
                <i class="c-icon" id="btnClearInput" style="display: none"></i>
            </div>
        </div>
        <a href="javascript:;" class="s-btn" id="btnSearch">搜索</a>
    </div>
    <!--搜索时显示的模块-->
    <div class="search-info" style="display: none;">
        <div class="hot">
            <p class="title">热门搜索</p>
            <ul id="ulSearchHot" class="hot-list clearfix"><li wd='iPhone'><a class="items">iPhone</a></li><li wd='三星'><a class="items">三星</a></li><li wd='小米'><a class="items">小米</a></li><li wd='黄金'><a class="items">黄金</a></li><li wd='汽车'><a class="items">汽车</a></li><li wd='电脑'><a class="items">电脑</a></li></ul>
        </div>
        <div class="history">
            <p class="title">历史记录</p>
            <div class="his-inner" id="divSearchHotHistory">
                <ul class="his-list thin-bor-top">
                    <li wd="小米移动电源" class="thin-bor-bottom"><a class="items">小米移动电源</a></li>
                    <li wd="苹果6" class="thin-bor-bottom"><a class="items">苹果6</a></li>
                    <li wd="苹果电脑" class="thin-bor-bottom"><a class="items">苹果电脑</a></li>
                </ul>
                <div class="cle-cord thin-bor-bottom" id="btnClear">清空历史记录</div>
            </div>
        </div>
    </div>

    <!--搜索结果模块-->
    <div class="good-result pad-top-86" id="loadingPicBlock">
        <!--搜索有结果时-->
        <div class="goodList" style="display: block;">
            <div class="result-num thin-bor-bottom pos-fix-44" id="divResultTip">
                <p>
                    共搜索到&nbsp;
                    <span class="orange" id="spCount">2</span>
                    &nbsp;个相关商品
                </p>
                <div class="add-car-all" id="multipleAddToCartBtn">一键加入购物车</div>
            </div>

            <ul id="ulGoodsList">
                <li id="23901">    
                    <span class="gList_l fl">        
                        <img src="https://img.1yyg.net/GoodsPic/pic-200-200/20170310160621945.jpg">    
                    </span>    
                    <div class="gList_r">        
                        <h3 class="gray6">(第330497云)平安银行 平安福金章 Au9999 2g</h3>        
                        <em class="gray9">价值：￥650.00</em>        
                        <div class="gRate">            
                            <div class="Progress-bar">                
                                <p class="u-progress">
                                    <span style="width: 90.92307692307692%;" class="pgbar">
                                        <span class="pging"></span>
                                    </span>
                                </p>                
                                <ul class="Pro-bar-li">                    
                                    <li class="P-bar01"><em>591</em>已参与</li>                    
                                    <li class="P-bar02"><em>650</em>总需人次</li>                    
                                    <li class="P-bar03"><em>59</em>剩余</li>                
                                </ul>            
                            </div>            
                            <a codeid="13470136" class=""><s></s></a>        
                        </div>    
                    </div>
                </li>
                <li id="23901">    
                    <span class="gList_l fl">        
                        <img src="https://img.1yyg.net/GoodsPic/pic-200-200/20170310160621945.jpg">    
                    </span>    
                    <div class="gList_r">        
                        <h3 class="gray6">(第330497云)平安银行 平安福金章 Au9999 2g</h3>        
                        <em class="gray9">价值：￥650.00</em>        
                        <div class="gRate">            
                            <div class="Progress-bar">                
                                <p class="u-progress">
                                    <span style="width: 90.92307692307692%;" class="pgbar">
                                        <span class="pging"></span>
                                    </span>
                                </p>                
                                <ul class="Pro-bar-li">                    
                                    <li class="P-bar01"><em>591</em>已参与</li>                    
                                    <li class="P-bar02"><em>650</em>总需人次</li>                    
                                    <li class="P-bar03"><em>59</em>剩余</li>                
                                </ul>            
                            </div>            
                            <a codeid="13470136" class=""><s></s></a>        
                        </div>    
                    </div>
                </li>
            </ul>
        </div>

        <!--搜索无结果时-->
        <div class="null-search-wrapper" id="divNoneData" style="display: none">
            <div class="null-search-inner">
                <i class="null-search-icon"></i>
                <p class="gray9">抱歉，没有您想要的商品！</p>
            </div>

            <div class="hot-recom">
                <div class="title thin-bor-top gray6">人气推荐</div>
                <div class="goods-wrap thin-bor-top">
                    <ul class="goods-list clearfix" id="ulRec"></ul>
                </div>
            </div>
        </div>

    </div>

    

<div class="footer clearfix" style="display:none;">
    <ul>
        <li class="f_home"><a href="/v47/index.do" ><i></i>潮购</a></li>
        <li class="f_announced"><a href="/v47/lottery/" ><i></i>最新揭晓</a></li>
        <li class="f_single"><a href="/v47/post/index.do" ><i></i>晒单</a></li>
        <li class="f_car"><a id="btnCart" href="/v47/mycart/index.do" ><i></i>购物车</a></li>
        <li class="f_personal"><a href="/v47/member/index.do" ><i></i>我的潮购</a></li>
    </ul>
</div>

<script src="js/jquery-1.11.2.min.js"></script>
</body>
</html>
