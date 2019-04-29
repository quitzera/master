<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>扫码登录</title>
</head>
<body>
    <center>
        <img src="/wxcode.png" alt="">
        <p id="status"></p>
        <p id="countDown"></p>
    </center>
</body>
</html>
<script src="jquery-3.2.1.min.js"></script>
<script>
    $(function () {
        $("#status").text("请扫描二维码");
        time = 30
        function countDown(){
            if(time > 0){
                $("#countDown").text("还剩"+time+"秒");
                time--
            }else{
                $("#countDown").text("二维码已失效")
                $("img").hide()
                $("#status").hide()
                clearInterval(countDown())
                clearInterval(status())

            }
        }
        function status(){
            $.ajax({
                url:'/status?rand'+Math.random()
                ,data:{_token:"{{csrf_token()}}",user_id:"{{$user_id}}"}
                ,success:function (res) {
                    if (res == 2){
                        $("#status").text("请在手机端确认登陆");
                    }else if (res != 1 && res !== 2){
                        location.href = "/saveInfo/"+res;
                    }
                }
            })
        }
        setInterval(countDown,1000)
        setInterval(status,3000)
    })
</script>