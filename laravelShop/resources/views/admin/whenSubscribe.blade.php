<link rel="stylesheet" href="/weui-master/dist/style/weui.css">
<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
<div class="weui-cells__title">添加</div>
<form action="/saveMsg" method="post" enctype="multipart/form-data">
    @csrf
<div class="weui-cells">
    <div class="weui-cell weui-cell_select">
        <div class="weui-cell__bd">
            <select class="weui-select" name="type" id="sel">
                <option selected="" value="text">文本</option>
                <option value="news">图文</option>
                <option value="voice">音频</option>
                <option value="audio">音乐</option>
                <option value="image">图片</option>
                <option value="video">视频</option>
            </select>
        </div>
    </div>
</div>
<div class="text one">
    <div class="weui-cells weui-cells_form">
        <div class="weui-cell">
            <div class="weui-cell__bd">
                <textarea class="weui-textarea" name="content" placeholder="请输入文本" rows="3"></textarea>
                <div class="weui-textarea-counter"><span>0</span>/200</div>
            </div>
        </div>
    </div></div>
<div class="multi one" style="display: none;">
    <div class="weui-cells">
        <div class="weui-cell">
            <div class="weui-cell__bd">
                <input class="weui-input" name="title" type="text" placeholder="请输入标题"/>
            </div>
        </div>
    </div>        <div class="weui-cells">
        <div class="weui-cell">
            <div class="weui-cell__bd">
                <input class="weui-input" type="file" name="material"/>
            </div>
        </div>
    </div>        <div class="weui-cells">
        <div class="weui-cell">
            <div class="weui-cell__bd">
                <input class="weui-input" type="text" name="describe" placeholder="描述"/>
            </div>
        </div>
    </div>        <div class="weui-cells">
        <div class="weui-cell">
            <div class="weui-cell__bd">
                <input class="weui-input" type="text" name="url" placeholder="链接至"/>
            </div>
        </div>
    </div>
</div>
<div class="media one" style="display: none;">
    <div class="weui-cells">
        <div class="weui-cell">
            <div class="weui-cell__bd">
                <input class="weui-input" id="media" type="file" name=""/>
            </div>
        </div>
    </div>
</div>

        <input type="submit" value="添加" class="weui-btn weui-btn_primary" id="showTooltips">

</form>


<script src="/jquery-3.2.1.min.js"></script>
<script>
    $("#sel").change(function(){
        if($(this).val() == 'text'){
            $(".text").show();
            $(".text").siblings(".one").hide();
            $("#media").prop('name',"");
        }else if($(this).val() == 'news'){
            $(".multi").show();
            $(".multi").siblings(".one").hide();
            $("#media").attr('name',"");
        }else{
            $(".media").show();
            $(".media").siblings(".one").hide();
            $("#media").attr('name',"material");
        }
    })
</script>