<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    //
    protected $table = "shop_menu";

    public $timestamps = false;

    protected $primaryKey = "m_id";
}
