<?php

use Illuminate\Database\Seeder;

class deliverySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $arr = [['state_del' => 0],['state_del' => 1]];
      
    DB::table('delivery')->insert($arr);
    }
}
