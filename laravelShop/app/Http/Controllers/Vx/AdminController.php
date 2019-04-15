<?php
namespace App\Http\Controllers\Vx;

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
use App\Http\Model\Vx;
use App\Http\Model\Subscribe;
use App\Http\Model\Menu;


class AdminController extends Controller
{
    function index(){
        return view('admin.index');
    }

    function chose(){
        $type = config('vx.type');
        return view('admin.chose',['type'=>$type]);
    }

    function dealData(){
        $str = '{"menu":{"button":[{"type":"click","name":"升级服务","key":"V1001_TODAY_MUSIC","sub_button":[]},{"name":"免费","sub_button":[{"type":"view","name":"少女升级少妇","url":"http:\/\/www.soso.com\/","sub_button":[]},{"type":"miniprogram","name":"少妇升级熟女","url":"http:\/\/mp.weixin.qq.com","sub_button":[],"appid":"wx286b93c14bbf93aa","pagepath":"pages\/lunar\/index"},{"type":"click","name":"熟女升级人妻","key":"V1001_GOOD","sub_button":[]}]}]}}';
        $totalArray = [];
        $arr = json_decode($str,true)['menu']['button'];
        foreach ($arr as $key=>$value){
            $Lvl1Tmp = [];
            $Lvl1Tmp['pid'] = 0;
            $Lvl1Tmp['name'] = $value['name'];
            $Lvl1Tmp['type'] = isset($value['type'])?$value['type']:'';
            $Lvl1Tmp['key'] = isset($value['key'])?$value['key']:'';
            $Lvl1Tmp['url'] = isset($value['url'])?$value['url']:'';
            $totalArray[] = $Lvl1Tmp;
            if(!empty($value['sub_button'])){
                foreach ($value['sub_button'] as $k=>$v){
                    $Lvl2Tmp = [];
                    $Lvl2Tmp['pid'] = $key+1;
                    $Lvl2Tmp['name'] = $v['name'];
                    $Lvl2Tmp['type'] = isset($v['type'])?$v['type']:'';
                    $Lvl2Tmp['key'] = isset($v['key'])?$v['key']:'';
                    $Lvl2Tmp['url'] = isset($v['url'])?$v['url']:'';
                    $totalArray[] = $Lvl2Tmp;
                }
            }
        }
        foreach ($totalArray as $v){
            Menu::insert($v);
        }
    }

    function passMenu(Request $request){
        $total = json_decode($request->total,true);
        $total = array_filter($total);
        $new = [];
        $new['button'] = $total;
        $str = json_encode($new,JSON_UNESCAPED_UNICODE);
        $vx = new Vx();
        $token = Vx::readAccessToken();
        $re = $vx->request_post("https://api.weixin.qq.com/cgi-bin/menu/create?access_token=$token",$str);
        return $re;
    }

    function addMenu(){
        $data = Menu::where('pid',0)->get();
        return view("admin.addMenu",['data'=>$data]);
    }

    function welcome(){
        return view("admin.welcome");
    }

    function whenSubscribe(){
        return view("admin.whenSubscribe");
    }

    function saveMsg(Request $request){
        $material = $request->material;
        $vx = new Vx();

        if($material){
            $picurl = $vx->uploadFile($material);
        }
        $type = $request->type;
        $title = $request->title;
        $url = $request->url;
        $describe = $request->describe;
        $obj = new Subscribe();
        $obj->url = $url;
        $obj->type = $type;
        $obj->title = $title;
        $obj->describe = $describe;
        $obj->picurl = $picurl;
        $obj->save();
    }

    function changeType(Request $request){
        $type = $request->type;
        $path = config_path("vx.php");
        $arr = ['type'=>$type];
        file_put_contents($path,"<?php return ".var_export($arr,true)."; ?>");
    }

    function defineMenu(){
        return view("admin.defineMenu");
    }
}
