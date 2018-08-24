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
      return $this->belongsToMany('App\Product','carts','user_id','product_id')->withPivot('user_id','product_id');
    }

    public function addToCart($product,$order_number) {
      
       $max_order = 10;
      for ($i=$max_order-$order_number; $i < $max_order; $i++) {
        // code...
      $this->products()->attach($product);
    }
  }

    public function changeOrderNumber($product_id, $order_number) {

      $changed_order = $this->products()->detach($product_id);
      return $this->addToCart($product_id,$order_number);

    }

    public function uniqueProduct() {

      foreach ($this->products as $product) {
        $product['product_pivot_id'] = $product->pivot->product_id;
      }

      return $this->products->unique('product_pivot_id');
      // exit;
    }

}
