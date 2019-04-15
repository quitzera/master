<?php

namespace App\Http\Shop;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    protected $table = 'shop_category';

    protected $primaryKey = 'cate_id';

    public $timestamps = false;
}
