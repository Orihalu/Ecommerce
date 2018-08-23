<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Product;


class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function products() {
      return $this->belongsToMany('App\Product','carts','user_id','product_id');
    }

    public function add_to_cart($product,$order_number) {
      for ($i=10-$order_number; $i < 10; $i++) {
        // code...
      $this->products()->attach($product);
    }
  }

}
