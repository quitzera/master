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
use App\Http\Controllers\TestController;


class AdminController extends Controller
{
    function index(){
        return view('admin.index');
    }
    
    function VxLogin(Request $request){
        $code = $request->code;
        $appid = env('VXAPPID');
        $appsecret = env('VXAPPSECRET');
        $url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid=$appid&secret=$appsecret&code=$code&grant_type=authorization_code";
        $data = file_get_contents($url);
        $data = json_decode($data,true);
        $access_token = $data['access_token'];
        $openid = $data['openid'];
        $url = "https://api.weixin.qq.com/sns/userinfo?access_token=$access_token&openid=$openid&lang=zh_CN";
        $info = file_get_contents($url);
        echo $info;
    }

    function code(){
        return view('code');
    }

    public function getList()
    {
        $token = Vx::readAccessToken();
        $url = "https://api.weixin.qq.com/cgi-bin/user/get?access_token=$token";
        $re = json_decode(file_get_contents($url));
        $url1 = "https://api.weixin.qq.com/cgi-bin/material/add_news?access_token=$token";
        $vx = new Vx();
        $info = "{
    \"articles\": [{
     \"title\": 'hello',
    \"thumb_media_id\": 'wyIeJXk5w68yPoFZsHWIFqUQqZIxgr_Ip5_6pv0wsOtIxsJAF12gJAMuYwMemeJY',
    \"show_cover_pic\": 0,
    \"content\": 'no message',
    \"content_source_url\": 'http://39.107.86.183',
},
]
}";
        $media_id = $vx->request_post($url1,$info);
        dd($media_id);die;
        $media_id = json_decode($media_id,true)['media_id'];
        $data = "{
               \"touser\":".json_encode($re->data->openid).",
               \"mpnews\":{
                  \"media_id\":\"$media_id\"
               },
                \"msgtype\":\"mpnews\"，
                \"send_ignore_reprint\":0
            }";
        return $data;
    }

    public function UserList(){
        $vx = new Vx();
        $token = Vx::readAccessToken();
        $url = "https://api.weixin.qq.com/cgi-bin/user/get?access_token=$token";
        $re = json_decode(file_get_contents($url),true);
        $data = $re['data']['openid'];
        $url = "https://api.weixin.qq.com/cgi-bin/user/info/batchget?access_token=$token";
        $arr = [];
        foreach ($data as $v){
            $arr[] = ['openid' => $v];
        }
        $json = [
            "user_list"=>
                $arr
        ];
        $json = json_encode($json,JSON_UNESCAPED_UNICODE);
        $re = $vx->request_post($url,$json);
        $arr = json_decode($re,true)['user_info_list'];
        $collector = [];
        foreach ($arr as $v){
            $collector[] = ['nickname'=>$v['nickname'],'openid'=>$v['openid']];
        }
        $tags = file_get_contents("https://api.weixin.qq.com/cgi-bin/tags/get?access_token=$token");
        $tags = json_decode($tags,true)['tags'];
        return view('admin.UserList',['data'=>$collector,'tags'=>$tags]);
    }

    function adminTagSend(Request $request){
        $json = "{
   \"filter\":{
      \"is_to_all\":false,
      \"tag_id\":$request->tagid
   },
   \"text\":{
      \"content\":'$request->contents'
   },
    \"msgtype\":'text'
}";
        echo $json;die;
        $token = Vx::readAccessToken();
        $url = "https://api.weixin.qq.com/cgi-bin/message/mass/sendall?access_token=$token";
        $vx = new Vx();
        $re = $vx->request_post($url,$json);
        echo $re;
    }

    function adminOpenidSend(Request $request){
        $openid = rtrim($request->collector,',');
        $openid = explode(',',$openid);
        $openid = json_encode($openid);
        $json = "{
   \"touser\":$openid,
    \"msgtype\": \"text\",
    \"text\": { \"content\": '$request->contents'}
}";
        echo $json;die;
        $token = Vx::readAccessToken();
        $url = "https://api.weixin.qq.com/cgi-bin/message/mass/send?access_token=$token";
        $vx = new Vx();
        $re = $vx->request_post($url,$json);
        echo $re;
    }

    function bindUser(Request $request){
        $openid = rtrim($request->collector,',');
        $openid = explode(',',$openid);
        $openid = json_encode($openid);
        $tagid = $request->tagid;
        $token = Vx::readAccessToken();
        $json = "{   
    \"openid_list\" : 
    $openid
       ,   
    \"tagid\" : $tagid
 }";
        $url = "https://api.weixin.qq.com/cgi-bin/tags/members/batchtagging?access_token=$token";
        $vx = new Vx();
        $re = $vx->request_post($url,$json);
        echo $re;
    }

    function getUserInTag(){
        $json = "{   \"tagid\" : 100}";
        $token = Vx::readAccessToken();
        $url = "https://api.weixin.qq.com/cgi-bin/user/tag/get?access_token=$token";
        $vx = new Vx();
        $re = $vx->request_post($url,$json);
        echo $re;
    }

    function personalMenu(){
        $json = "{
    \"button\": [
        {
            \"type\": \"click\", 
            \"name\": \"music~\", 
            \"key\": \"V1001_TODAY_MUSIC\"
        }, 
        {
            \"name\": \"菜单\", 
            \"sub_button\": [
                {
                    \"type\": \"view\", 
                    \"name\": \"搜索\", 
                    \"url\": \"http://www.soso.com/\"
                }, 
                {
                    \"type\": \"miniprogram\", 
                    \"name\": \"wxa\", 
                    \"url\": \"http://mp.weixin.qq.com\", 
                    \"appid\": \"wx286b93c14bbf93aa\", 
                    \"pagepath\": \"pages/lunar/index\"
                }, 
                {
                    \"type\": \"click\", 
                    \"name\": \"赞一下我们\", 
                    \"key\": \"V1001_GOOD\"
                }
            ]
        }
    ], 
    \"matchrule\": {
        \"tag_id\": \"101\", 
    }
}";
        $token = Vx::readAccessToken();
        $url = "https://api.weixin.qq.com/cgi-bin/menu/addconditional?access_token=$token";
        $vx = new Vx();
        $re = $vx->request_post($url,$json);
        echo $re;
    }

    function createTag(){
        $json = "{   \"tag\" : {     \"name\" : \"hello\"} }";
        $token = Vx::readAccessToken();
        $vx = new Vx();
        $url = "https://api.weixin.qq.com/cgi-bin/tags/create?access_token=$token";
        $re = $vx->request_post($url,$json);
        echo $re;
    }

    public function groupSend(){
        $token = TestController::readAccessToken();
        $url = "https://api.weixin.qq.com/cgi-bin/message/mass/send?access_token=$token";
        $vx = new Vx();
        $data = $this->getList();
        $re = $vx->request_post($url,$data);
        dd($re);
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

    function deleteMenu(){
        $access_token = Vx::readAccessToken();
        $url = "https://api.weixin.qq.com/cgi-bin/menu/delete?access_token=".$access_token;
        $vx = new Vx();
        $result = $vx->request_post($url,'');
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
            $data = $vx->uploadFile($material);
            $picurl = $data[1];
            $media_id = $data[0];
        }
        $type = $request->type;
        $title = $request->title;
        $url = $request->url;
        $describe = $request->describe;
        $obj = new Subscribe();
        $obj->url = $url;
        $obj->media_id = $media_id;
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
