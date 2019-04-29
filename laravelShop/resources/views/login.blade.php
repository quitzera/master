@extends('master')
@section('content')
    <link href="css/comm.css" rel="stylesheet" type="text/css" />
    <link href="css/login.css" rel="stylesheet" type="text/css" />
    <link href="css/vccode.css" rel="stylesheet" type="text/css" />

<body>
    
<!--触屏版内页头部-->


<div class="wrapper">
    <div class="registerCon">
        <div class="binSuccess5">
            <ul>
                <li class="accAndPwd">
                    <dl>
                        <div class="txtAccount">
                            <input id="txtAccount" type="text" placeholder="请输入您的手机号码/邮箱"><i></i>
                        </div>
                        <cite class="passport_set" style="display: none"></cite>
                    </dl>
                    <dl>
                        <input id="txtPassword" type="password" placeholder="密码" value="" maxlength="20" /><b></b>
                    </dl>
                    <dl>
                        <input id="code" name="code" type="text" placeholder="请输入验证码" value="" style="display: inline;width:640px;"/><b></b>
                        <img id="captcha" src="{{url('getCode')}}" style="display: inline">
                    </dl>
                </li>
            </ul>
            <a id="sub" href="javascript:;" class="orangeBtn loginBtn">登录</a>
        </div>
        <div class="forget">
            <a href="https://m.1yyg.com/v44/passport/FindPassword.do">忘记密码？</a> <a href="{{$url}}">微信登录</a><b></b><a href="https://m.1yyg.com/v44/passport/register.do?forward=https%3a%2f%2fm.1yyg.com%2fv44%2fmember%2f">新用户注册</a>
        </div>
    </div>
    <div class="oter_operation gray9" style="display: none;">
        <p>登录666潮人购账号后，可在微信进行以下操作：</p>
        1、查看您的潮购记录、获得商品信息、余额等<br />
        2、随时掌握最新晒单、最新揭晓动态信息
    </div>
</div>

</body>
    <script>
        $(function(){
                $('#sub').click(function(){
                    var tel = $('#txtAccount').val();
                    var pwd = $('#txtPassword').val();
                    var code = $('#code').val();
                    $.ajax({
                        url:'/loginDo',
                        data:{tel:tel,pwd:pwd,code:code,openid:"{{$openid}}"}
                        ,method:"post"
                        ,success:function(res){
                           if(res.code == 1){
                               location.href = '/';
                           }else{
                               alert('信息有误');
                               $("#captcha").trigger('click');
                           }
                        }
                        ,dataType:'json'
                    }
                    )
                })

            $("#captcha").click(function(){
                $(this).attr('src',"{{url('getCode')}}"+"?"+Math.random())
            })
        })
    </script>
@endsection
