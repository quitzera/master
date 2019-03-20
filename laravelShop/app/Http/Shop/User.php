<?php

namespace App\Http\Shop;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    //
    protected $table = 'shop_user';

    protected $primaryKey = 'user_id';

    public $timestamps = true;
}
