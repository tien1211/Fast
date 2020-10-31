<?php

use Illuminate\Database\Seeder;

class imgSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $arr = [];
      $faker = Faker\Factory::create('vi_vn');

      for($i=0;$i<31;$i++){
            array_push($arr,[
                'id_food' => $faker->unique()->numberBetween($min=1,$max=31),
                'file_img'=> "anh".$i.".png",
                'state_img'=> 1
            ]);
      }
      DB::table('img')->insert($arr);
    }
}
