@extends('master')
@section('content')
    <link href="css/mywallet.css" rel="stylesheet" type="text/css" />
<body>
    
<!--触屏版内页头部-->


    <div class="wallet-con">
        <div class="w-item">
            <ul class="w-content clearfix">
                <li>
                    <a href="">编辑个人资料</a>
                    <s class="fr"></s>
                </li>
                <li>
                    <a href="">邀请有奖</a>
                    <s class="fr"></s>
                </li>
                <li>
                    <a href="">安全设置</a>
                    <s class="fr"></s>
                </li>
                <li>
                    <a href="">客服热线（9:00-17:00）</a>
                    <s class="fr"></s>
                    <span class="fr">400-666-2110</span>
                </li>           
            </ul>     
        </div>
        <div class="quit">
            <a href="">退出登录</a>
        </div>
    </div>
</body>
@endsection
