<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Product;
use DB;
use Auth;

class User extends \TCG\Voyager\Models\User
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
      DB::beginTransaction();

       $max_order = 10;
       $start_num = $max_order-$order_number;
       $stock_left = $product->stock - $order_number;
// dd($product->stock);
       try {
             if($product->updated_at > Product::findOrFail($product->id) ) {
             //Productのupdateがrequestよりも新しいとき
             return redirect()->back()->with('exclusive_lock_exception', 'no stock left');

           } elseif($stock_left < 0) {
           //stockから$order_numberを引いた数が0未満の場合
           return redirect()->back()->with('exclusive_lock_exception', 'no stock left');
         }
          //add処理
            for ($i=$start_num; $i < $max_order; $i++) {

            $this->products()->attach($product->id);
          }
            $product->stock = $stock_left;
            $product->save();
            DB::commit();

       } catch (\Exception $e) {
          DB::rollback();
       }
  }

    public function changeOrderNumber($product_id, $order_number) {
      DB::beginTransaction();

      $product = Product::findOrFail($product_id);
      //relationをカウントしてstockにたす
      $reset_stock = $product->stock + $this->products->where('id',$product->id)->count();
      $product->stock = $reset_stock;
      $product->save();

      try {
        if($reset_stock - $order_number < 0) {
          return redirect()->back()->with('exclusive_lock_exception', 'no stock left');

        }

        $this->products()->detach($product->id);
        DB::commit();

      } catch (\Exception $e) {
        DB::rollback();
      }
      return $this->addToCart($product,$order_number);
    }


    public function uniqueProduct() {

      foreach ($this->products as $product) {
        $product['product_pivot_id'] = $product->pivot->product_id;
      }

      return $this->products->unique('product_pivot_id');
      // exit;
    }

    public function getTotalSum() {
      $total_sum = 0;
      foreach($this->products as $product) {
        $total_sum += $product->price;
      }
      return money_format('$%i',$total_sum);;
}


}
