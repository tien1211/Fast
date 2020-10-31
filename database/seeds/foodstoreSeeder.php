<?php

use Illuminate\Database\Seeder;

class foodstoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker =    Faker\Factory::create('vi_vn');
        $arr = [];
        for($i=0;$i<31;$i++){
            array_push($arr,[
                'id_food'   => $faker->unique()->numberBetween($min=1,$max=31),
                'id_store'  => $faker->numberBetween($min=1,$max=5),

            ]);

        }
        DB::table('foodstore')->insert($arr);
    }
}
