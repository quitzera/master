<?php

namespace App\Http\Shop;

use Illuminate\Database\Eloquent\Model;

class Goods extends Model
{
    //
    protected $table = 'shop_goods';

    protected $primaryKey = 'goods_id';

    public $timestamps = false;
}
