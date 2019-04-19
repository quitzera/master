<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Model\Vx;
use Illuminate\Support\Facades\Redis;
use App\Http\Model\User;
class TestController extends Controller
{
    //
    public static function getAccessToken()
    {
        $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=wx5ed5e2085a554cad&secret=0967d5967e91ebaeefa5c9220b04df24";
        return file_get_contents($url);
    }

    public static function readAccessToken()
    {
        if(Redis::exists("AccessToken")){
            $info = unserialize(base64_decode(Redis::get('AccessToken')));
            if($info['expire'] > time()){
                return $info['AccessToken'];
            }else{
                $token = json_decode(self::getAccessToken(),true)['access_token'];
                $expire = time() + 7000;
                $info = ['AccessToken'=>$token,'expire'=>$expire];
                $info = base64_encode(serialize($info));
                Redis::set('AccessToken',$info);
                return $token;
            }
        }else{
            $token = json_decode(self::getAccessToken(),true)['access_token'];
            $expire = time() + 7000;
            $info = ['AccessToken'=>$token,'expire'=>$expire];
            $info = base64_encode(serialize($info));
            Redis::set('AccessToken',$info);
            return $token;
        }
    }

    public static function whenSubscribe($postObj)
    {
        $token = Vx::readAccessToken();
        $openId = $postObj->FromUserName;
        $url = "https://api.weixin.qq.com/cgi-bin/user/info?access_token=$token&openid=$openId&lang=zh_CN";
        $info = file_get_contents($url);
        $info = json_decode($info,true);
        $new = new User();
        $new->name = $info['nickname'];
        $new->subscribe = $info['subscribe'];
        $new->openId = $info['openid'];
        $re = $new->save();
    }

    public function menu()
    {
        $json = '{
    "button": [
        {
            "name": "扫码", 
            "sub_button": [
                {
                    "type": "scancode_waitmsg", 
                    "name": "扫码带提示", 
                    "key": "rselfmenu_0_0", 
                    "sub_button": [ ]
                }, 
                {
                    "type": "scancode_push", 
                    "name": "扫码推事件", 
                    "key": "rselfmenu_0_1", 
                    "sub_button": [ ]
                }
            ]
        }, 
        {
            "name": "发图", 
            "sub_button": [
                {
                    "type": "pic_sysphoto", 
                    "name": "系统拍照发图", 
                    "key": "rselfmenu_1_0", 
                   "sub_button": [ ]
                 }, 
                {
                    "type": "pic_photo_or_album", 
                    "name": "拍照或者相册发图", 
                    "key": "rselfmenu_1_1", 
                    "sub_button": [ ]
                }, 
                {
                    "type": "pic_weixin", 
                    "name": "微信相册发图", 
                    "key": "rselfmenu_1_2", 
                    "sub_button": [ ]
                }
            ]
        }, 
        {
            "name": "发送位置", 
            "type": "location_select", 
            "key": "rselfmenu_2_0"
        }
    ]
}';
        $token = $token = Vx::readAccessToken();
        $url = "https://api.weixin.qq.com/cgi-bin/menu/create?access_token=$token";
        $vx = new Vx();
        $vx->request_post($url,$json);
    }
}
