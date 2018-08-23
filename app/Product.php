<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
      'name', 'price', 'detail', 'description', 'category_id',
    ];

    public function users(){
      return $this->belongsToMany('App\User','carts','product_id','user_id');
    }

}
