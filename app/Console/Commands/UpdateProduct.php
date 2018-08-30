<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;

class UpdateProduct extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'updateproduct';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
      \DB::table('users')
           ->where('id', 1)
           ->update(['name' => str_random(10)]);

     $this->info('User Name Change Successfully!');
    }
}
