<?php

namespace App\Http\Shop;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    //
    protected $table = 'shop_cart';

    protected $primaryKey = 'id';

    public $timestamps = false;
}
