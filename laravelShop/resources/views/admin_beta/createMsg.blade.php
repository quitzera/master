<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<form action="/saveMsg" method="post" enctype="multipart/form-data">
    @csrf
    <select id="sel">
        <option value="1">文字</option>
        <option value="2">图文</option>
        <option value="3">音乐</option>
        <option value="4">音频</option>
        <option value="5">视频</option>
        <option value="6">图片</option>
    </select>
    <div class="text">
        <textarea name="content" id="" cols="30" rows="10"></textarea>
    </div>
    <div class="multi" style="display: none;">
        <input type="text" name="title" placeholder="请输入标题"><br><br>
        <input type="file" name="material" id="chose"><br><br>
        <input type="text" name="describe" placeholder="描述"><br><br>
        <input type="text" name="url" placeholder="链接至">
    </div>
    <div class="media" style="display: none;">
        <input type="file" name="" id="media">
    </div>
    <input type="submit" value="添加">
</form>
</body>
</html>
<script src="/jquery-3.2.1.min.js"></script>
<script>
    $("#sel").change(function(){
        if($(this).val() == 1){
            $(".text").show();
            $(".text").siblings("div").hide();
            $("#media").prop('name',"");
        }else if($(this).val() == 2){
            $(".multi").show();
            $(".multi").siblings("div").hide();
            $("#media").prop('name',"");
            $("#chose").prop('name',"material");
        }else{
            $(".media").show();
            $(".media").siblings("div").hide();
            console.log($("#chose"),$("#media"));
            $("#chose").prop('name',"");
            $("#media").prop('name',"material");
        }
    })
</script>