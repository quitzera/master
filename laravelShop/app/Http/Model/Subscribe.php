<?php
namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Subscribe extends Model
{
    //
    protected $table = "shop_subscribe";
    protected $primaryKey = "s_id";
    public $timestamps = false;
}
