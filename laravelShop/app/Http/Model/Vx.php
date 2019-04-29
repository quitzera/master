<?php
namespace App\Http\Model;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\DB;
use App\Http\Model\Order;
use App\Http\Model\User;
use App\Http\Model\Goods;

class Vx
{
    //
    function request_post($url,$param) {


        $postUrl = $url;
        $curlPost = $param;
        $ch = curl_init();//初始化curl
        curl_setopt($ch, CURLOPT_URL,$postUrl);//抓取指定网页
        curl_setopt($ch, CURLOPT_HEADER, 0);//设置header
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);//要求结果为字符串且输出到屏幕上
        curl_setopt($ch, CURLOPT_POST, 1);//post提交方式
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);//post提交方式
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);//post提交方式
        curl_setopt($ch, CURLOPT_POSTFIELDS, $curlPost);
        $data = curl_exec($ch);//运行curl
        curl_close($ch);

        return $data;
    }

    function test($content,$FromUserName,$ToUserName){
        $textTpl = "<xml>
  <ToUserName><![CDATA[%s]]></ToUserName>
  <FromUserName><![CDATA[%s]]></FromUserName>
  <CreateTime>%s</CreateTime>
  <MsgType><![CDATA[%s]]></MsgType>
  <Content><![CDATA[%s]]></Content>
</xml>";
        $time = time();
        return sprintf($textTpl,$FromUserName,$ToUserName,$time,'text',$content);
    }

    static function saveImage($path) {
        $image_name = $newFileName = date("Ymd")."/".mt_rand(1000,9999).".".'jpg';
        $ch = curl_init ($path);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_BINARYTRANSFER,1);
        $img = curl_exec ($ch);
        curl_close ($ch);
//$image_name就是要保存到什么路径,默认只写文件名的话保存到根目录
        $re = Storage::disk('uploads')->put($image_name,$img);
        return $re;
    }

    function selectMaterial($type,$offset,$count){
        $data = [];
        $data['type'] = $type;
        $data['offset'] = $offset;
        $data['count'] = $count;
        $token = Vx::readAccessToken();
        $url = "https://api.weixin.qq.com/cgi-bin/material/batchget_material?access_token=$token";
        $vx = new Vx();
        $re = $vx->request_post($url,json_encode($data));
        echo $re;
    }

    function uploadFile($file){

        $vx = new Vx();
        $type = $file->getClientMimeType();
        $type = $vx->changeType(explode('/',$type)[0]);
//        $type = 'thumb';
        $ext = $file->getClientOriginalExtension();
        $path = $file->getRealPath();
        $newFileName = date("Ymd")."/".mt_rand(1000,9999).".".$ext;
        $re = Storage::disk('uploads')->put($newFileName,file_get_contents($path));
        $imgpath = public_path()."/uploads/".$newFileName;
        $arr = array(
            'media'=>new \CURLFile(realpath($imgpath))
        );
        $token = Vx::readAccessToken();
        $url = "https://api.weixin.qq.com/cgi-bin/media/upload?access_token=$token&type=$type";
        $re = $vx->request_post($url,$arr);
        $media_id = json_decode($re,true)['media_id'];
        return [$media_id,url("/uploads/".$newFileName)];
    }

    function bindAccess($fromUserName,$toUserName){
        $flag = User::where('openid',$fromUserName)->count();
        if($flag){
            $content = "欢迎回来";
        }else{
            $content = "欢迎使用，点我去绑定账号 http://39.107.86.183/login?openid=$fromUserName";
        }
        $textTpl = "<xml>
  <ToUserName><![CDATA[%s]]></ToUserName>
  <FromUserName><![CDATA[%s]]></FromUserName>
  <CreateTime>%s</CreateTime>
  <MsgType><![CDATA[%s]]></MsgType>
  <Content><![CDATA[%s]]></Content>
</xml>";
        $time = time();
        return sprintf($textTpl,$fromUserName,$toUserName,$time,'text',$content);
    }

    function newGoods($FromUserName,$ToUserName){
        $data = Goods::orderBy('goods_id','desc')->get()->toArray();
        $textTpl = "<xml>
  <ToUserName><![CDATA[%s]]></ToUserName>
  <FromUserName><![CDATA[%s]]></FromUserName>
  <CreateTime>%s</CreateTime>
  <MsgType><![CDATA[%s]]></MsgType>
  <ArticleCount>5</ArticleCount>
  <Articles>
    <item>
      <Title><![CDATA[%s]]></Title>
      <Description><![CDATA[%s]]></Description>
      <PicUrl><![CDATA[%s]]></PicUrl>
      <Url><![CDATA[%s]]></Url>
    </item> <item>
      <Title><![CDATA[%s]]></Title>
      <Description><![CDATA[%s]]></Description>
      <PicUrl><![CDATA[%s]]></PicUrl>
      <Url><![CDATA[%s]]></Url>
    </item> <item>
      <Title><![CDATA[%s]]></Title>
      <Description><![CDATA[%s]]></Description>
      <PicUrl><![CDATA[%s]]></PicUrl>
      <Url><![CDATA[%s]]></Url>
    </item> <item>
      <Title><![CDATA[%s]]></Title>
      <Description><![CDATA[%s]]></Description>
      <PicUrl><![CDATA[%s]]></PicUrl>
      <Url><![CDATA[%s]]></Url>
    </item> <item>
      <Title><![CDATA[%s]]></Title>
      <Description><![CDATA[%s]]></Description>
      <PicUrl><![CDATA[%s]]></PicUrl>
      <Url><![CDATA[%s]]></Url>
    </item>
  </Articles>
</xml>";
        $time = time();
        return sprintf($textTpl,$FromUserName,$ToUserName,$time,'news',$data[0]['goods_name'],$data[0]['self_price'],"http://39.107.86.183/uploads/{$data[0]['goods_img']}","http://39.107.86.183/detail/{$data[0]['goods_id']}",$data[1]['goods_name'],$data[1]['self_price'],"http://39.107.86.183/uploads/{$data[1]['goods_img']}","http://39.107.86.183/detail/{$data[1]['goods_id']}",$data[2]['goods_name'],$data[2]['self_price'],"http://39.107.86.183/uploads/{$data[2]['goods_img']}","http://39.107.86.183/detail/{$data[2]['goods_id']}",$data[3]['goods_name'],$data[3]['self_price'],"http://39.107.86.183/uploads/{$data[3]['goods_img']}","http://39.107.86.183/detail/{$data[3]['goods_id']}",$data[4]['goods_name'],$data[4]['self_price'],"http://39.107.86.183/uploads/{$data[4]['goods_img']}","http://39.107.86.183/detail/{$data[4]['goods_id']}");
    }

    function text($info,$FromUserName,$ToUserName){
        $textTpl = "<xml>
  <ToUserName><![CDATA[%s]]></ToUserName>
  <FromUserName><![CDATA[%s]]></FromUserName>
  <CreateTime>%s</CreateTime>
  <MsgType><![CDATA[%s]]></MsgType>
  <Content><![CDATA[%s]]></Content>
</xml>";
        $time = time();
        return sprintf($textTpl,$FromUserName,$ToUserName,$time,'text',$info->content);
    }

    function VxLogin($info,$FromUserName,$ToUserName){
        $textTpl = "<xml>
  <ToUserName><![CDATA[%s]]></ToUserName>
  <FromUserName><![CDATA[%s]]></FromUserName>
  <CreateTime>%s</CreateTime>
  <MsgType><![CDATA[%s]]></MsgType>
  <Content><![CDATA[%s]]></Content>
</xml>";
        $time = time();
    $appid = env('VXAPPID');
    $uri = urlencode("http://aulei521.com/testByWangyan.php");
    $url = "https://open.weixin.qq.com/connect/oauth2/authorize?appid=$appid&redirect_uri=$uri&response_type=code&scope=snsapi_userinfo&state=123123#wechat_redirect";
    return sprintf($textTpl,$FromUserName,$ToUserName,$time,'text',$url);
    }

    function getTemplet($content,$to){
        $rule = "/(\d+)$/";
        preg_match($rule,$content,$no);
        $info = Order::where('order_no',$no)->first();
        if(empty($info)){
            echo '';
        }
        $data = [
            'touser'=>"$to"
            ,'template_id'=>"IGW7xV6DOs_MLZ2KImOxdWloB6xdNtHfDLLPpVezPbA",
            'data'=>[
                'order_no'=>[
                    "value"=>"$info->order_no",
                       "color"=>"#173177"
                ], 'status'=>[
                    "value"=>"$info->pay_status",
                       "color"=>"#173177"
                ], 'created_at'=>[
                    "value"=>"$info->created_at",
                       "color"=>"#173177"
                ], 'total'=>[
                    "value"=>"$info->order_amount",
                       "color"=>"#173177"
                ]
            ]
        ];
        $json = json_encode($data,JSON_UNESCAPED_UNICODE);
        $token = self::readAccessToken();
        $url = "https://api.weixin.qq.com/cgi-bin/message/template/send?access_token=$token";
        $re = $this->request_post($url,$json);
        echo $re;
    }

    function turing($text,$FromUserName,$ToUserName){
        $textTpl = "<xml>
  <ToUserName><![CDATA[%s]]></ToUserName>
  <FromUserName><![CDATA[%s]]></FromUserName>
  <CreateTime>%s</CreateTime>
  <MsgType><![CDATA[%s]]></MsgType>
  <Content><![CDATA[%s]]></Content>
</xml>";
        $data=[
            'perception'=>[
                'inputText'=>[
                    'text'=>$text
                ]
            ],
            'userInfo'=>[
                'apiKey'=>'b1f75ef8274a427a869065946da8f2f4',
                'userId'=>123123,
            ]
        ];
        $post_data=json_encode($data);//变成json数据
        $url="http://openapi.tuling123.com/openapi/api/v2";
        $re=$this->request_post($url,$post_data);//调用模板，传送数据
        $msg=json_decode($re,true)['results'][0]['values']['text'];
        $msgType = "text";
        $contentStr = $msg;
        return sprintf($textTpl, $FromUserName, $ToUserName, time(), $msgType, $contentStr);
    }

    function news($info,$FromUserName,$ToUserName){
        $textTpl = "<xml>
  <ToUserName><![CDATA[%s]]></ToUserName>
  <FromUserName><![CDATA[%s]]></FromUserName>
  <CreateTime>%s</CreateTime>
  <MsgType><![CDATA[%s]]></MsgType>
  <ArticleCount>1</ArticleCount>
  <Articles>
    <item>
      <Title><![CDATA[%s]]></Title>
      <Description><![CDATA[%s]]></Description>
      <PicUrl><![CDATA[%s]]></PicUrl>
      <Url><![CDATA[%s]]></Url>
    </item>
  </Articles>
</xml>";
        $time = time();
        return sprintf($textTpl,$FromUserName,$ToUserName,$time,'news',$info->title,$info->describe,$info->picurl,$info->url);
    }

    function returnGoodsInfo($name,$FromUserName,$ToUserName){
        $textTpl = "<xml>
  <ToUserName><![CDATA[%s]]></ToUserName>
  <FromUserName><![CDATA[%s]]></FromUserName>
  <CreateTime>%s</CreateTime>
  <MsgType><![CDATA[%s]]></MsgType>
  <ArticleCount>1</ArticleCount>
  <Articles>
    <item>
      <Title><![CDATA[%s]]></Title>
      <Description><![CDATA[%s]]></Description>
      <PicUrl><![CDATA[%s]]></PicUrl>
      <Url><![CDATA[%s]]></Url>
    </item>
  </Articles>
</xml>";
        $info = DB::table("shop_goods")->where('goods_name','like',"%$name%")->first();
        $time = time();
        return sprintf($textTpl,$FromUserName,$ToUserName,$time,'news',$info->goods_name,$info->goods_desc,url("uploads/".$info->goods_img),url("/detail/$info->goods_id"));
    }

    function changeType($str){
        $arr = [
          'image'=>'image'
            ,'audio'=>'voice'
            ,'video'=>'video'
        ];
        return $arr[$str];
    }

    static function readAccessToken(){
        $data = json_decode(file_get_contents("accessToken.txt"),true);
        if($data && $data[1] > time()-7000){
            $accessToken = $data[0];
        }else{
            $accessToken = self::getAccessToken();
            $accessToken = json_decode($accessToken,true);
            $str = json_encode([$accessToken['access_token'],time()]);
            file_put_contents("accessToken.txt",$str);
            $accessToken = $accessToken['access_token'];
        }
        return $accessToken;
    }

    static function getAccessToken(){
        $token = file_get_contents("https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=wx5ed5e2085a554cad&secret=0967d5967e91ebaeefa5c9220b04df24");
        return $token;
    }
}
