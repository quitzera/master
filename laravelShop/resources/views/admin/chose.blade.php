<link rel="stylesheet" href="/weui-master/dist/style/weui.css">
<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
<div class="weui-cell weui-cell_select">
    <div class="weui-cell__bd">
        <select class="weui-select" name="type" id="type">
            <option selected="" value="text">文本</option>
            <option value="news">图文</option>
            <option value="audio">音乐</option>
            <option value="video">视频</option>
            <option value="voice">音频</option>
            <option value="image">图片</option>
        </select>
    </div>
</div>
<script src="/jquery-3.2.1.min.js"></script>
<script>
$(function(){
    $("option").each(function () {
        var type = $(this).val()
        if(type == "{{$type}}"){
            $(this).prop('selected',true);
        }
    })

    $("#type").change(function () {
        var type = $("option:selected").val()
        $.post(
            "/changeType"
            ,{_token:"{{csrf_token()}}",type:type}
            ,function(res){
                alert("操作已提交");
            }
        )
    })
})
</script>