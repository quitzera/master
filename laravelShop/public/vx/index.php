<?php
define("TOKEN","hehehe");

class vx{
    public function do(){
        $res = $this->check();
        if($res){
            return $_GET['echostr'];
        }
    }
    private function check(){
        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];

        $tmpArr = array(TOKEN,$timestamp, $nonce);
        sort($tmpArr, SORT_STRING);
        $tmpStr = implode( $tmpArr );
        $tmpStr = sha1( $tmpStr );

        if( $signature == $tmpStr){
            return true;
        }else{
            return false;
        }
    }
}