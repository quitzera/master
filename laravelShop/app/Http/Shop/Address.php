<?php
namespace App\Http\Shop;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    //
    protected $table = "shop_address";

    public $timestamps = false;

    protected $primaryKey = 'address_id';
}
