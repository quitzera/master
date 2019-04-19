<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
    protected $table = "shop_order";

    protected $primaryKey = "order_id";

    public $timestamps = false;
}
