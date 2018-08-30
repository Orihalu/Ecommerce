<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Console\Commands;
use App\User;
use Auth;
use Carbon\Carbon;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        '\App\Console\Commands\UpdateProduct',
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')
        //          ->hourly();
         // $schedule->call(function () {
         //   \DB::table('users')
         //        ->where('id', 1)
         //        ->update(['name' => str_random(10)]);
         // })->cron('* * * * *');
         // command('updateproduct --force')->cron('* * * * *');
         $schedule->call(function () {
           $now = Carbon::now();
           $users = User::all();
           foreach($users as $user) {
             $products = $user->products;
             foreach ($products as $product) {
               $add_cart_date = $product->pivot->created_at;
               if($now->diffInDays($add_cart_date) > 7) {
                 $product_id = $product->id;
                 $order_number = 0;
                  $user->changeOrderNumber($product_id,$order_number);
                  // \DB::table('users')
                  //      ->where('id', 1)
                  //      ->update(['name' => str_random(10)]);
               }
             }
           }
         })->cron('* * * * *');

    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
