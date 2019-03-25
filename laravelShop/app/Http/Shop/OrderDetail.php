<?php

namespace App\Http\Shop;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    //
    public $timestamps = true;

    protected $table = "shop_order_detail";

    protected $primaryKey = "id";
}
