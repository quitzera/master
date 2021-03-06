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
use App\Http\Controllers\TestController;
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
        $fileName = 'log/'.date('Ymd').'.txt';
        $event = empty((string)$postObj->Event)?'':(string)$postObj->Event;
        $content = empty((string)$postObj->Content)?'':(string)$postObj->Content;
        $arr = [
            'openId' => (string)$FromUserName
            ,'msgType' => (string)$postObj->MsgType
            ,'event' => $event
            ,'content' => $content
        ];
        $str = serialize($arr)."\r\n";
        file_put_contents($fileName,$str,FILE_APPEND);
        $info = Subscribe::where('type',config('vx.type'))->orderBy('s_id','desc')->first();
        $msgtype = isset($info->type)?$info->type:'';
        $vx =  new Vx();
        if($postObj->MsgType == 'image'){
            $re = Vx::saveImage($postObj->PicUrl);
            $re = $re?'收到！':'啥啥啥?';
            $resultStr = $vx->test($re,$FromUserName,$ToUserName);
            echo $resultStr;
        }else if($postObj->MsgType == "event"){
            if($postObj->Event == "subscribe"){
                $resultStr = $vx->bindAccess($FromUserName,$ToUserName);
                echo $resultStr;
//                TestController::whenSubscribe($postObj);
            }else if($postObj->Event == "CLICK"){
                if($postObj->EventKey == "newGoods"){
                    $resultStr = $vx->newGoods($FromUserName,$ToUserName);
                    echo $resultStr;
                }
            }else if ($postObj->Event == "VIEW"){
            $u_id = User::where('openid',(string)$FromUserName)->first()->user_id;
            session(['u_id'=>$u_id]);
        }
        }
        else if($postObj->Content == "回复"){
            $resultStr = $vx->$msgtype($info,$FromUserName,$ToUserName);
            echo $resultStr;
        }else if($postObj->Content == "最新商品"){
            $resultStr = $vx->newGoods($FromUserName,$ToUserName);
            echo $resultStr;
        }else if(explode(' ',$postObj->Content)[0] == "商品"){
            $resultStr = $vx->returnGoodsInfo(explode(' ',$postObj->Content)[1],$FromUserName,$ToUserName);
            echo $resultStr;
        }else if(strstr($postObj->Content,'订单')){
            $vx->getTemplet($postObj->Content,$FromUserName);
        }else if($postObj->Content == "登录"){
            $resultStr = $vx->VxLogin($info,$FromUserName,$ToUserName);
            echo $resultStr;
        }else{
            $resultStr = $vx->turing($postObj->Content, $FromUserName, $ToUserName);
            echo $resultStr;
        }
    }
}
