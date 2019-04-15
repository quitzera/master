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
class VxController extends Controller
{
    function do(){
        $this->start();
    }

    function start(){
        $postStr = file_get_contents("php://input");
        $postObj = simplexml_load_string($postStr);
        $FromUserName = $postObj->FromUserName;
        $ToUserName = $postObj->ToUserName;
        $info = Subscribe::where('type',config('vx.type'))->orderBy('s_id','desc')->first();
        $msgtype = $info->type;
        $vx =  new Vx();
        if($postObj->Content == "回复"){
            $resultStr = $vx->$msgtype($info,$FromUserName,$ToUserName);
            echo $resultStr;
        }else if(explode(' ',$postObj->Content)[0] == "商品"){
            $resultStr = $vx->returnGoodsInfo(explode(' ',$postObj->Content)[1],$FromUserName,$ToUserName);
            echo $resultStr;
        }else{
            $resultStr = $vx->turing($postObj->Content, $FromUserName, $ToUserName);
            echo $resultStr;
        }
    }
}
