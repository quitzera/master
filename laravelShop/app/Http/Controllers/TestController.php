<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Model\Vx;
use Illuminate\Support\Facades\Redis;

class TestController extends Controller
{
    //
    public function getAccessToken()
    {
        $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=wx5ed5e2085a554cad&secret=0967d5967e91ebaeefa5c9220b04df24";
        return file_get_contents($url);
    }

    public function readAccessToken()
    {
        if(Redis::exists("AccessToken")){
            $info = unserialize(base64_decode(Redis::get('AccessToken')));
            if($info['expire'] > time()){
                return $info['AccessToken'];
            }else{
                $token = $this->getAccessToken();
                $expire = time() + 7000;
                $info = ['AccessToken'=>$token,'expire'=>$expire];
                $info = base64_encode(serialize($info));
                Redis::set('AccessToken',$info);
                return $token;
            }
        }else{
            $token = $this->getAccessToken();
            $expire = time() + 7000;
            $info = ['AccessToken'=>$token,'expire'=>$expire];
            $info = base64_encode(serialize($info));
            Redis::set('AccessToken',$info);
            return $token;
        }
    }
}
