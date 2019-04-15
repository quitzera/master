<?php
   //连接本地的 Redis 服务
   $redis = new Redis();
   $redis->connect('127.0.0.1', 6379);
   echo "Connection to server successfully";
   $redis->close();
   $redis->lpush("tutorial-list", "Redis");
   $redis->lpush("tutorial-list", "Mongodb");
   $redis->lpush("tutorial-list", "Mysql");
   // 获取存储的数据并输出
   $arList = $redis->lrange("tutorial-list", 0 ,5);
   echo "Stored string in redis";
   print_r($arList);
   echo '<br>';
   $arList = $redis->keys("*");
   echo "Stored keys in redis:: ";
   print_r($arList);


