<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    public function products() {
      return $this->belongsToMany('App\Product')->withTimestamps();
    }

    public function user() {
      return $this->belongsTo('App\User');
    }
}
