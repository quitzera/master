<?php
namespace App\Http\Controllers\Index;

use App\Http\Shop\Cart;
use App\Http\Shop\Order_address;
use App\Http\Shop\Order_detail;
use App\Http\Shop\User;
use DemeterChain\C;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Shop\Goods;
use App\Http\Shop\Category;
use Illuminate\Routing\Route;
use App\Http\Controllers\Extend\Captcha;
use App\Http\Controllers\Extend\MobileCode;
use App\Http\Shop\Address;
use App\Http\Shop\Area;
use Illuminate\Support\Facades\DB;
use App\Http\Shop\OrderAddress;
use App\Http\Shop\OrderDetail;
use Redis;
use App\Http\Controllers\Extend\alipay\wappay\service\AlipayTradeService;
use App\Http\Controllers\Extend\alipay\wappay\buildermodel\AlipayTradeWapPayContentBuilder;

class IndexController extends Controller
{
    //
    public function Index(Request $request)
    {
        $data = Goods::where('is_new',1)->limit(2)->get();
        $hot = Goods::where('is_hot',1)->limit(4)->get();
        return view('Index',['data'=>$data,'hot'=>$hot,'type'=>1,'signPackage'=>$request->signPackage]);
    }

    public function do(){
        $res = $this->checkSign();
        if($res){
            return $_GET['echostr'];
        }
    }
    private function checkSign(){
        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];

        $tmpArr = array("hehehe",$timestamp, $nonce);
        sort($tmpArr, SORT_STRING);
        $tmpStr = implode( $tmpArr );
        $tmpStr = sha1( $tmpStr );

        if( $signature == $tmpStr){
            return true;
        }else{
            return false;
        }
    }

    public function detail($id,Request $request){
        $info = Goods::find($id);
        $info->goods_imgs = explode('|',rtrim($info->goods_imgs,'|'));
        return view('shopcontent',['info'=>$info,'type'=>2,'signPackage'=>$request->signPackage]);
    }

    public function share()
    {
        $data = DB::table('shop_order_detail')->where('u_id',session('u_id'))->join('shop_user','shop_user.user_id','=','shop_order_detail.u_id')->join('shop_goods','shop_goods.goods_id','=','shop_order_detail.goods_id')->orderBy('shop_order_detail.created_at','desc')->get();
        foreach ($data as $v){
            $v->goods_imgs = explode('|',rtrim($v->goods_imgs,'|,'));
        }
        return view('share',['data'=>$data,'type'=>3]);
    }

    public function mobileCode(Request $request){
        $info = User::where('user_email',$request->tel)->first();
        if($info){
            $data = ['font'=>'已被注册','code'=>2];
            echo json_encode($data);
            die;
        }
        $code = mt_rand(1000,9999);
        session(['mobileCode'=>$code]);
        session(['sendTime'=>time()]);
        $mobile = new MobileCode();
        $mobile->getCode($code,$request->tel);
    }

    function address(Request $request){
        $areas = Area::all();
        $data = Address::where('shop_address.user_id',session('u_id'))->join('shop_user','shop_user.user_id','=','shop_address.user_id')->get();
        foreach ($data as $k=>$v){
            foreach ($areas as $val){
                if($v->province == $val->id){
                    $data[$k]->province_name = $val->name;
                }
                if($v->city == $val->id){
                    $data[$k]->city_name = $val->name;
                }
                if($v->area == $val->id){
                    $data[$k]->area_name = $val->name;
                }
            }
        }
            return view('address',['type'=>5,'data'=>$data]);
    }

    function payment(Request $request){
        $user_id = session('u_id');
        $ids = $request->ids;
        $ids = explode(',',$ids);
        $data = Cart::whereIn('shop_cart.id',$ids)->join('shop_goods','shop_goods.goods_id','=','shop_cart.goods_id')->get();
        $price = 0;
        foreach($data as $v){
            $price += $v->buy_num*$v->self_price;
        }
        return view('payment',['type'=>4,'data'=>$data,'price'=>$price]);
    }



    function return_(Request $request){
        if($request->request){
            return true;
        }else{
            return false;
        }
    }

    function pay(Request $request){
        if($request->ids == ''){
            return false;
        }
        session(['payIds'=>$request->ids]);
        $price = $this->countThis();
        $config = config('alipay');
        //商户订单号，商户网站订单系统中唯一订单号，必填
        $out_trade_no = date("Ymdhis").rand(1000,9999);

        //订单名称，必填
        $subject = 'wdnmd一个沙箱哪里来的那么多事？';

        //付款金额，必填
        $total_amount = "$price";

        //商品描述，可空
        $body = '';

        //超时时间
        $timeout_express="3m";

        $payRequestBuilder = new AlipayTradeWapPayContentBuilder();
        $payRequestBuilder->setBody($body);
        $payRequestBuilder->setSubject($subject);
        $payRequestBuilder->setOutTradeNo($out_trade_no);
        $payRequestBuilder->setTotalAmount($total_amount);
        $payRequestBuilder->setTimeExpress($timeout_express);

        $payResponse = new AlipayTradeService($config);
        $result=$payResponse->wapPay($payRequestBuilder,$config['return_url'],$config['notify_url']);
        return ;
    }

    function countThis(){
        if(session('payIds') == ''){
            return false;
        }
        $ids = session('payIds');
        $ids = explode(',',$ids);
        $data = Cart::whereIn('id',$ids)->join('shop_goods','shop_goods.goods_id','=','shop_cart.goods_id')->get();
        //订单表
        $price = 0;
        foreach($data as $v){
            $price += $v->self_price*$v->buy_num;
        }
        return $price;
    }

    function theFinal(){
        if(session('payIds') == ''){
            return redirect("/payment?ids=".session('payIds'));
        }
        DB::beginTransaction();
        try {
            $ids = session('payIds');
            $ids = explode(',',$ids);
            $data = Cart::whereIn('id',$ids)->join('shop_goods','shop_goods.goods_id','=','shop_cart.goods_id')->get();
            //订单表
            $price = 0;
            foreach($data as $v){
                $price += $v->self_price*$v->buy_num;
            }
            $info =[];
            $info['order_amount'] = $price;
            $info['order_no'] = mt_rand(100000,999999).time();
            $info['u_id'] = session('u_id');
            $info['created_at'] = date('Y-m-d H:i:s',time());
            $id = DB::table('shop_order')->insertGetId($info);
            //订单地址表
            $info = Address::where(['user_id'=>session('u_id'),'is_default'=>1,'address_status'=>1])->first();
            $insert = new OrderAddress();
            $insert->order_id = $id;
            $insert->u_id = session('u_id');
            $insert->address_name = $info->user_name;
            $insert->address_tel = $info->tel;
            $insert->province = $info->province;
            $insert->city = $info->city;
            $insert->county = $info->area;
            $insert->address_area = $info->address_detail;
            $insert->created_at = date('Y-m-d H:i:s',time());
            $insert->save();
            //订单详情表
            foreach($data as $v){
                $insert = new OrderDetail();
                $insert->order_id = $id;
                $insert->u_id = session('u_id');
                $insert->goods_id = $v->goods_id;
                $insert->buy_num = $v->buy_num;
                $insert->self_price = $v->self_price;
                $insert->goods_name = $v->goods_name;
                $insert->goods_img = $v->goods_img;
                $insert->save();
            }
            //购物车表
            Cart::whereIn('id',$ids)->delete();
            //商品表

            foreach($data as $v){
                $goods_num = $v->goods_num - $v->buy_num;
                $_id = $v->goods_id;
                $info = Goods::find($_id);
                $info->goods_num = $goods_num;
                $info->save();
            }
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
        }
    }

    public function all(){
        $data = Goods::where('is_new',1)->get();
        $carts = Category::where(['p_id'=>0,'cate_show'=>1])->get();
        return view('allshops',['data'=>$data,'carts'=>$carts,'cate_id'=>0,'type'=>2]);
    }

    function buyRecord(){
        $data = DB::table('shop_order_detail')->where('u_id',session('u_id'))->join('shop_user','shop_user.user_id','=','shop_order_detail.u_id')->orderBy('shop_order_detail.created_at','desc')->get();
        $beta = [];
        if(!$data){
            $beta = Goods::where(['is_hot'=>1,'is_up'=>1])->get();
        }
        return view('buyrecord',['type'=>5,'data'=>$data,'beta'=>$beta]);
    }

    function writeaddr(){
        $province = Area::where('pid',0)->get();
        return view('writeaddr',['type'=>5,'province'=>$province]);
    }


    function unity(Request $request){
        $val = $request->val;
        $data = Area::where('pid',$val)->get();
        echo json_encode($data);
    }

    public function getGoods(Request $request)
    {
        $condition = empty($request->cate_id)?0:$request->cate_id;
        $keywords =empty($request->keywords)?'':$request->keywords;
        $sort = empty($request->sort)?0:$request->sort;
        $arr = [['goods_num','asc'],['goods_num','desc'],['goods_id','desc'],['self_price','desc'],['self_price','asc']];
        $ids = $this->getCateData($condition);
        $data = Goods::whereIn('cate_id',$ids)->where('goods_name','like',"%$keywords%")->where('is_up',1)->orderBy($arr[$sort][0],$arr[$sort][1])->get();
        return view('goodsframe',['data'=>$data,'cate_id'=>$condition]);
    }

    function getCateData($cate_id){
        $data = Category::all();
        static $arr = [];
        foreach($data as $v){
            if($v->p_id == $cate_id){
                $arr[] = $v->cate_id;
                $this->getCateData($v->cate_id);
            }
        }
        return $arr;
    }

    function delAddr(Request $request){
        $id = $request->id;
        echo $id;
        Address::destroy($id);
    }

    function success(){
        $this->theFinal();
        $data = Goods::where('is_hot',1)->get();
        return view('paysuccess',['data'=>$data]);
    }

    function defaultThis(Request $request){
        $id = $request->id;
        $data = Address::where('user_id',session('u_id'))->get();
        foreach($data as $k=>$v){
            if($v->address_id == $id){
                $data[$k]->is_default = 1;
            }else{
                $data[$k]->is_default = 2;
            }
            $data[$k]->save();
        }
    }

    function createAddr(Request $request){
        $info = $request->input();
        if(empty($info['is_default'])){
            $info['is_default'] = 2;
        }
        $info['user_id'] = session('u_id');
        $res = DB::table('shop_address')->insert($info);
        if($res){
            return redirect('/address');
        }else{
            return redirect('writeaddr');
        }
    }

    function getPrice(Request $request){
        $info = $request->ids;
        $info = array_chunk(explode(',',$info),2);
        $data = Goods::all();
        $price = 0;
        foreach ($info as $v){
            foreach($data as $vv){
                if($v[0] == $vv->goods_id){
                    $price += $v[1]*$vv->self_price;
                }
            }
        }
        return $price;
    }

    function intoCart(Request $request){
        $goods_id = $request->goods_id;
        $user_id = session('u_id');
        $info = Cart::where(['goods_id'=>$goods_id,'user_id'=>$user_id,'cart_status'=>1])->first();
        if($info){
            $info->buy_num += 1;
            $res = $info->save();
        }else{
            $obj = new Cart();
            $obj->goods_id = $goods_id;
            $obj->user_id = $user_id;
            $obj->buy_num = 1;
            $obj->cart_status = 1;
            $res = $obj->save();
        }
    }

    function getCode(){
        $captcha = new Captcha();
        $captcha->doimg();
        $code = $captcha->getCode();
        session(['captcha'=>$code]);
    }

    function test(){

   //连接本地的 Redis 服务
   $redis = new Redis();
   $redis->connect('127.0.0.1', 6379);
   echo "Connection to server successfully";
   //设置 redis 字符串数据
   $redis->set("tutorial-name", "Redis tutorial");
   // 获取存储的数据并输出
   echo "Stored string in redis:: " . $redis->get("tutorial-name");

    }

    function cart(Request $request){
        $goods = Goods::where('is_hot',1)->limit(4,0)->get();
        $data = Cart::where(['user_id'=>session('u_id'),'cart_status'=>1])->join('shop_goods','shop_goods.goods_id','=','shop_cart.goods_id')->get();
        return view('shopcart',['data'=>$data,'type'=>4,'goods'=>$goods,'signPackage'=>$request->signPackage]);
    }

    function cartDel(Request $request){
        $id = $request->id;
        $id = explode(',',$id);
        $info = Cart::whereIn('id',$id)->get();
        foreach($info as $v){
            $v->cart_status = 2;
            $v->save();
        }
    }

    function calculate(Request $request){
        $buy_num = $request->num;
        $cart_id = $request->cart_id;
        $info = Cart::find($cart_id);
        $info->buy_num = $buy_num;
        $info->save();
    }

    function user(){
        $user_id = session('u_id');
        $info = User::find($user_id);
        return view('userpage',['info'=>$info,'type'=>5]);
    }

    function set(){
        return view('set',['type'=>5]);
    }

    function login(Request $request){
        $appid = env('VXAPPID');
        $uri = urlencode("http://aulei521.com/accept.php");
        $url = "https://open.weixin.qq.com/connect/oauth2/authorize?appid=$appid&redirect_uri=$uri&response_type=code&scope=snsapi_userinfo&state=123123#wechat_redirect";
        if(!isset($request->openid)){
            $openid = '';
        }else{
            $openid = $request->openid;
        }
        return view("login",['openid'=>5,'type'=>5,'url'=>$url,'signPackage'=>$request->signPackage]);
    }

    function telUnique(Request $request){
        $tel = $request->tel;
        $info = User::where('user_email',$tel)->first();
        if($info){
            $data = ['font'=>'已存在','code'=>2];
        }else{
            $data = ['font'=>'可用','code'=>1];
        }
        echo json_encode($data);
    }

    function register(){
        return view('register',['type'=>5]);
    }


    function registerDo(Request $request){
        $tel = $request->tel;
        $pwd = $request->pwd;
        $time = session('sendTime');
        if(time() - $time > 300){
            $data = ['font'=>'超时','code'=>2];
            echo json_encode($data);
            die;
        }
        $info = User::where('user_email',$tel)->first();
        if($info){
            $data = ['font'=>'已被注册','code'=>2];
            echo json_encode($data);
            die;
        }
        if($request->Mcode != session('mobileCode')){
            $data = ['font'=>'验证码错误','code'=>2];
            echo json_encode($data);
            die;
        }
        $obj = new User;
        $obj->user_email = $tel;
        $obj->user_pwd = encrypt($pwd);
        $obj->save();
        $info = User::where('user_email',$tel)->first();
        $id = $info->user_id;
        $code = $request->code;
        if($code != session('captcha')){
            $data = ['font'=>'信息有误','code'=>2];
            echo json_encode($data);
            die;
        }
        if($info){
            $data = ['font'=>'成功','code'=>1];
            session(['u_id'=>$id]);
        }else{
            $data = ['font'=>'失败','code'=>2];
        }
        echo json_encode($data);
    }
    function loginDo(Request $request){
        $tel = $request->tel;
        $pwd = $request->pwd;
        $code = $request->code;
        if($code != session('captcha')){
            $data = ['font'=>'信息有误','code'=>2];
            echo json_encode($data);
            die;
        }
        $info = User::where('user_email',$tel)->first();

        if(!$info){
            $data = ['font'=>'信息有误','code'=>2];
        }else{
            if($pwd != decrypt($info->user_pwd)){
                $data = ['font'=>'信息有误','code'=>2];
            }else{
                if($info->openid == ''){
                    if(!empty($request->openid)){
                        $openid = $request->openid;
                        $info->openid = $openid;
                        $info->save();
                    }
                }
                $data = ['font'=>'登录成功','code'=>1];
                session(['u_id'=>$info->user_id]);
            }
        }
      echo json_encode($data);
    }
}
