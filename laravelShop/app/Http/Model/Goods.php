<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Goods extends Model
{
    //
    protected $table = "shop_goods";

    protected $primaryKey = "goods_id";

    public $timestamps = false;
}
