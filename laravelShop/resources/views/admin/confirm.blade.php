<link rel="stylesheet" href="/weui-master/dist/style/weui.css">
<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
<button class="weui-btn weui-btn_primary" id="confirm">确认登录</button>
<script src="jquery-3.2.1.min.js"></script>
<script>
    $("#confirm").click(function () {
        $.ajax({
            url:"/confirm"
            ,method:'post'
            ,data:{_token:"{{csrf_token()}}",openid:"{{$openid}}"}
            ,success:function (res) {
                if(res){
                    alert("登录成功，请在pc端继续操作")
                }
            }
        })
    })
</script>