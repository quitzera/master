<link rel="stylesheet" href="/weui-master/dist/style/weui.css">
<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
<script src="/jquery-3.2.1.min.js"></script>
<div style="display: block">
    <button class="addLvl1 weui-btn weui-btn_mini weui-btn_primary">一级菜单</button><input class="weui-input name" type="text" placeholder="菜单标题"/><input class="weui-input key" type="text" placeholder="菜单键值或链接地址"><select class="weui-select"><option></option><option>view</option><option>click</option><option>miniprogram</option></select>
    <button class="addLvl2 weui-btn weui-btn_mini weui-btn_primary">二级菜单？</button><div style="display: none" class="lvl2div"><button class="Lvl2 weui-btn weui-btn_mini weui-btn_primary">二级菜单</button><input class="weui-input name" type="text" placeholder="菜单标题"/><input class="weui-input key" type="text" placeholder="菜单键值或链接地址"><select class="weui-select type"><option>view</option><option>click</option><option>miniprogram</option></select></div>
</div><button class="invisible weui-btn weui-btn_mini weui-btn_primary">收起</button>
<div class="weui-btn-area">
    <a class="weui-btn weui-btn_primary" href="javascript:" id="showTooltips">确定</a>
</div>
<script>
    $(function(){
        //一级菜单相关
        $(document).on('click',".addLvl1",function () {
            var i = 0;
            $(".addLvl1").each(function () {
                i++
            })
            if(i < 3){
                $(this).parent().next().after($(this).parent().clone(true),$(this).parent().next().clone(true));
            }
        })
        //
        //召唤二级菜单
        $(document).on('click',".addLvl2",function () {
            var i = 0;
            $(this).nextAll("div").each(function () {
                i++
            })
            $(this).next().show()
            var flag = $(this).next().attr('flag')
            $(this).next().attr('flag',1)
            if(i < 5 && flag){
                $(this).next().clone(true).insertAfter($(this).next());
                $(this).next().next().show()
            }
        })
        //屏幕是不是成不下你了？
        $(document).on('click',".invisible",function () {
            var status = $(this).text();
            var _this = $(this)
            if(status == "收起"){
                _this.text('展开')
                _this.prev().hide()
            }else{
                _this.text('收起')
                _this.prev().show()
            }
        })

        $("#showTooltips").click(function () {
            var total = []
            var flag = 0;
            $(".addLvl1").each(function () {
                var name = $(this).next().val()
                var key = $(this).next().next().val()
                var type = $(this).next().next().next().val()
                var status = $(this).nextUntil("div").last().next().css('display')
                if(status != 'none'){
                    var sub_button = []
                    var flag2 = 0
                    $(this).nextAll(".lvl2div").each(function () {
                        var name = $(this).find(".name").val();
                        var key = $(this).find(".key").val();
                        var type = $(this).find(".type").val();
                        sub_button[flag2] = {name:name,type:type,url:key}
                        flag2 ++
                    })
                }
                total[flag] = {name:name,type:type,key:key,sub_button:sub_button}
                flag ++
            })
            var total = JSON.stringify(total)
            $.post(
                "/passMenu"
                ,{_token:"{{csrf_token()}}",total:total}
                ,function (res) {
                    alert(res);
                }
            )
        })
    })
</script>