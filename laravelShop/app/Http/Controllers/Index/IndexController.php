<?php

namespace App\Http\Controllers\Index;

use App\Http\Shop\Cart;
use App\Http\Shop\User;
use DemeterChain\C;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Shop\Goods;
use App\Http\Shop\Category;
use Illuminate\Routing\Route;
use App\Http\Controllers\Extend\Captcha;
use App\Http\Controllers\Extend\MobileCode;

class IndexController extends Controller
{
    //
    public function Index()
    {
        $data = Goods::where('is_new',1)->limit(2)->get();
        $hot = Goods::where('is_hot',1)->limit(4)->get();
        return view('Index',['data'=>$data,'hot'=>$hot,'type'=>1]);
    }

    public function detail($id){
        $info = Goods::find($id);
        $info->goods_imgs = explode('|',rtrim($info->goods_imgs,'|'));
        return view('shopcontent',['info'=>$info,'type'=>2]);
    }

    public function share()
    {
        return view('share');
    }

    public function mobileCode(Request $request){
        $code = mt_rand(1000,9999);
        session(['mobileCode'=>$code]);
        session(['sendTime'=>time()]);
        $mobile = new MobileCode();
        $mobile->getCode($code,$request->tel);
    }

    public function all(){
        $data = Goods::where('is_new',1)->get();
        $carts = Category::where(['p_id'=>0,'cate_show'=>1])->get();
        return view('allshops',['data'=>$data,'carts'=>$carts,'cate_id'=>0,'type'=>2]);
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

    function getCode(){
        $captcha = new Captcha();
        $captcha->doimg();
        $code = $captcha->getCode();
        session(['captcha'=>$code]);
    }

    function test(){
        echo session('mobileCode');
    }

    function cart(){
        $goods = Goods::where('is_hot',1)->limit(4,0)->get();
        $data = Cart::where(['user_id'=>session('u_id'),'cart_status'=>1])->join('shop_goods','shop_goods.goods_id','=','shop_cart.goods_id')->get();
        return view('shopcart',['data'=>$data,'type'=>4,'goods'=>$goods]);
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

    function login(){
        return view('login',['type'=>5]);
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
                $data = ['font'=>'登录成功','code'=>1];
                session(['u_id'=>$info->user_id]);
            }
        }
      echo json_encode($data);
    }
}
