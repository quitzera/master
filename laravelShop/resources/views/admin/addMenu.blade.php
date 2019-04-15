<link rel="stylesheet" href="/weui-master/dist/style/weui.css">
<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
<div class="weui-cells__title">添加</div>
<form action="/saveMsg" method="post" enctype="multipart/form-data">
    @csrf
    <div class="weui-cells">
        <div class="weui-cell weui-cell_select">
            <div class="weui-cell__bd">
                <select class="weui-select" name="type" id="sel">
                    <option selected="" value="view">view</option>
                    <option value="click">click</option>
                </select>
            </div>
        </div>
    </div><div class="weui-cells">
        <div class="weui-cell weui-cell_select">
            <div class="weui-cell__bd">
                <select class="weui-select" name="pid" id="sel">
                    <option selected="" value="0">顶级菜单</option>
                    @foreach($data as $v)
                        <option value="{{$v->m_id}}">{{$v->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    <div class="multi one" >
        <div class="weui-cells">
            <div class="weui-cell">
                <div class="weui-cell__bd">
                    <input class="weui-input" name="url" type="text" placeholder="连接/菜单键值"/>
                </div>
            </div>
        </div>
    </div>
    <div class="media one">
        <div class="weui-cells">
            <div class="weui-cell">
                <div class="weui-cell__bd">
                    <input class="weui-input" id="media" type="text" name="name" placeholder="请输入菜单名"/>
                </div>
            </div>
        </div>
    </div>

    <input type="submit" value="添加" class="weui-btn weui-btn_primary" id="showTooltips">

</form>


<script src="/jquery-3.2.1.min.js"></script>
<script>

</script>