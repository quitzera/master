<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head><meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>修改支付密码</title>
<meta content="app-id=984819816" name="apple-itunes-app" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, user-scalable=no, maximum-scale=1.0" />
<meta content="yes" name="apple-mobile-web-app-capable" />
<meta content="black" name="apple-mobile-web-app-status-bar-style" />
<meta content="telephone=no" name="format-detection" />
<link href="css/comm.css" rel="stylesheet" type="text/css" />
<link href="css/login.css" rel="stylesheet" type="text/css" />
<link href="css/findpwd.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="layui/css/layui.css">
<link rel="stylesheet" href="css/modipwd.css">
<script src="js/jquery-1.11.2.min.js"></script>
</head>
<body>
    
<!--触屏版内页头部-->
<div class="m-block-header" id="div-header">
    <strong id="m-title">修改登录密码</strong>
    <a href="javascript:history.back();" class="m-back-arrow"><i class="m-public-icon"></i></a>
    <a href="/" class="m-index-icon"><i class="m-public-icon"></i></a>
</div>



    <div class="wrapper">
        <form class="layui-form" action="">
            <div class="registerCon regwrapp">
                <div class="account">
                    <em>账户名：</em> <i>155****3866</i>
                </div>
                <div><em>当前密码</em><input type="password"></div>
                <div><em>新密码</em><input type="password" placeholder="请输入6-16位数字、字母组成的新密码"></div>
                <div><em>确认新密码</em><input type="password" placeholder="确认新密码"></div>
                <div class="save"><span>保存</span></div>
            </div>
        </form>
    </div>


<script src="layui/layui.js"></script>
<script>
//Demo
layui.use('form', function(){
  var form = layui.form();
  
  //监听提交
  form.on('submit(formDemo)', function(data){
    layer.msg(JSON.stringify(data.field));
    return false;
  });
});

</script>    

</body>
</html>
    