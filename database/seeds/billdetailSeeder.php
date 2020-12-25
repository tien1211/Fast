<?php

use Illuminate\Database\Seeder;

class billdetailSeeder extends Seeder
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

        
            for($j=0;$j<30;$j++){
                array_push($arr,[
                    'id_food'           => $faker->numberBetween($min=1,$max=31),
                    'id_bill'           => $faker->numberBetween($min=1,$max=25),
                    'qty_billdetail'    => $faker->numberBetween($min=1,$max=6),
                    'price_billdetail'  => $faker->numberBetween($min=500000,$max=1000000),
                   
                ]);
            
            }

        DB::table('billdetail')->insert($arr);
    }
}
