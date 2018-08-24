<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
      'name', 'price', 'detail', 'description', 'category_id',
    ];

    public function users(){
      return $this->belongsToMany('App\User','carts','product_id','user_id')->withPivot('user_id','product_id');
    }

    public function presentPrice() {
      return money_format('$%i', $this->price / 100);
    }

    public function productCount() {
      return $this->pivot->where('product_id',$this->id)->count();
    }


    public function getSum() {
      $sum = ($this->price/100)*$this->productCount();
      return money_format('$%i',$sum);
      // dd($sum);
    }

}
