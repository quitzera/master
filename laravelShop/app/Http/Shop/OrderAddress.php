<?php

namespace App\Http\Shop;

use Illuminate\Database\Eloquent\Model;

class OrderAddress extends Model
{
    //
    protected $table = "shop_order_address";

    protected $primaryKey = "id";

    public $timestamps = true;
}
