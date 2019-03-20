@foreach($data as $v)
    <li id="{{$v->goods_id}}">
                                    <span class="gList_l fl">
                                        <a href = '/detail/{{$v->goods_id}}'><img class="lazy" data-original="/uploads/{{$v->goods_img}}"></a>
                                    </span>
        <div class="gList_r">
            <h3 class="gray6">{{$v->goods_name}}</h3>
            <em class="gray9">价值：￥{{$v->self_price}}</em>
            <div class="gRate">
                <div class="Progress-bar">
                    <p class="u-progress">
                                                    <span style="width: 91.91286930395593%;" class="pgbar">
                                                        <span class="pging"></span>
                                                    </span>
                    </p>
                    <ul class="Pro-bar-li">
                        <li class="P-bar01"><em>7342</em>已参与</li>
                        <li class="P-bar02"><em>7988</em>总需人次</li>
                        <li class="P-bar03"><em>{{$v->goods_num}}</em>剩余</li>
                    </ul>
                </div>
                <a codeid="12785750" class="" canbuy="646"><s></s></a>
            </div>
        </div>
    </li>
@endforeach