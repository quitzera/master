<link rel="stylesheet" href="/weui-master/dist/style/weui.css">
<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
<div class="weui-cells__title">关注者列表</div>
@foreach($data as $v)
<div class="weui-cells">
    <div class="weui-cell">
        <div class="weui-cell__bd"> <p openid="{{$v['openid']}}">{{$v['nickname']}}</p></div>
        <div class="weui-cell__ft"> <input class="weui-switch" type="checkbox"/></div>
    </div>
</div>
@endforeach
<div class="weui-cell">
    <div class="weui-cell__bd">
        <select class="weui-select" name="type" id="type">
            @foreach($tags as $v)
            <option selected="" value="{{$v['id']}}">{{$v['name']}}</option>
          @endforeach
        </select>
    </div>
</div>
<div class="weui-btn-area">
    <a class="weui-btn weui-btn_primary" href="javascript:" id="showTooltips">与之标签</a>
</div>
<div class="weui-btn-area">
    <a class="weui-btn weui-btn_primary" href="javascript:" id="sendByOpenId">选中群发</a>
</div>
<div class="weui-btn-area">
    <a class="weui-btn weui-btn_primary" href="javascript:" id="sendByTag">标签群发</a>
</div>
<div class="weui-cells__title">群发内容</div>
<div class="weui-cells weui-cells_form">
    <div class="weui-cell">
        <div class="weui-cell__bd">
            <textarea class="weui-textarea" placeholder="请输入文本" rows="3" id="content"></textarea>
            <div class="weui-textarea-counter"><span>0</span>/200</div>
        </div>
    </div>
</div>
<script src="/jquery-3.2.1.min.js"></script>
<script>
$(function () {
    $("#showTooltips").click(function () {
        var collector = '';
        $("input:checkbox:checked").each(function () {
            var openid = $(this).parent().prev().children("p").attr('openid')
            collector += openid + ','
        })
        var tagid = $("#type").val()
        $.post(
            "/bindUser"
            ,{collector:collector,tagid:tagid,_token:"{{csrf_token()}}"}
            ,function (res) {
                alert('操作完成')
            }
        )
    })
    $("#sendByOpenId").click(function () {
        var content = $("#content").val()
        var collector = '';
        $("input:checkbox:checked").each(function () {
            var openid = $(this).parent().prev().children("p").attr('openid')
            collector += openid + ','
        })
        console.log(content)
        $.post(
            "/adminOpenidSend"
            ,{_token:"{{csrf_token()}}",collector:collector,contents:content}
            ,function (res) {
                alert('操作完成')
            }
        )
    })
    $("#sendByTag").click(function () {
        var content = $("#content").val()
        var tagid = $("#type").val()
        $.post(
            "/adminTagSend"
            ,{_token:"{{csrf_token()}}",tagid:tagid,contents:content}
            ,function (res) {
                alert('操作完成')
            }
        )
    })
})
</script>