@extends('master')
@section('content')
<link href="css/comm.css" rel="stylesheet" type="text/css" />
<link href="css/login.css" rel="stylesheet" type="text/css" />
<link href="css/findpwd.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="layui/css/layui.css">
<link rel="stylesheet" href="css/modipwd.css">
<script src="js/jquery-1.11.2.min.js"></script>
</head>
<body>
    




    <div class="wrapper">
        <form class="layui-form" lay-filter="formDemo">
            <div class="registerCon">
                <ul>
                    <li class="auth"><em>请输入验证码</em></li>
                    <li><p>我们已向<em class="red">150******9431</em>发送验证码短信，请查看短信并输入验证码。</p></li>
                    <li>
                        
                        <input type="text" id="userMobile" placeholder="请输入验证码" value=""/>
                        <a href="javascript:void(0);" class="sendcode" id="btn">获取验证码</a>
                    </li>
                    <li><a id="findPasswordNextBtn" href="javascript:void(0);" class="orangeBtn" lay-submit lay-filter="*">确认</a></li>
                    <li>换了手机号码或遗失？请致电客服解除绑定400-666-2110</li>
                </ul>
            </div>
        </form>
    </div>


<script src="layui/layui.js"></script>
<script>
//Demo
layui.use('form', function(){
  var form = layui.form();

  //监听提交
  form.on('submit(*)', function(data){
    return false;
  });

});

</script>
@endsection


    