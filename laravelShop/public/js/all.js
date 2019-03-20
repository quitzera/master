$(function(){
    layui.use(['layer', 'laypage', 'element'], function(){
      var layer = layui.layer
      ,laypage = layui.laypage
      ,element = layui.element(); 
   })


    function djs(name){    
      setInterval(function(){         
        $(name).each(function(){    
          var Obj = this;        
          var EndTime = new Date(parseInt($(Obj).attr('value')) * 1000); 
          var NowTime = new Date();   
          var nMS=EndTime.getTime() - NowTime.getTime();    
          var nD=Math.floor(nMS/(1000 * 60 * 60 * 24));    
          var nH=Math.floor(nMS/(1000*60*60)) % 24;    
          var nM=Math.floor(nMS/(1000*60)) % 60;    
          var nS=Math.floor(nMS/1000) % 60;    
          var mMS=Math.floor(nMS) % 1000;

          if(nM<10){
            var nM='<em>0'+nM+'</em>';
          }else if (nM >=10 && nM <=59) {
            var nM = '<em>'+nM+'</em>';
          } 
          if(nS<10){
             nS='<em>0'+nS+'</em>';
        
          }else if (nS >=10 && nS <=59) {
             nS = '<em>'+nS+'</em>';
          }
          if(mMS<10){
             mMS='<em>0'+mMS+'</em>';
          }else if (mMS>=10 && mMS<=999) {
             mMS = '<em>'+parseInt(mMS/10)+'</em>';
          }    
          if(nMS> 0){         
             str =nM+'<span>:</span>'+nS+'<span>:</span>'+mMS;    
            $(Obj).html(str);    
          }
          if(nMS<=0){
            $('.weishow').html($('.yishow').html());
          }     
        });    
      }, 100);
    }
    djs('.time-wrapper');

});