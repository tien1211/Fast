<?php

use Illuminate\Database\Seeder;

class storeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $arr = [];
        $faker = Faker\Factory::create('vi_VN');
        $name = array('KFC','Jollibee','LOTTERIA','McDonald','Popeye');
        $count = count($name);
        for($i=0;$i<5;$i++){
            array_push($arr,[
                'id_address'        =>    $faker->unique()->numberBetween($min = 1, $max = 5),
                'name_store'        =>   $name[$i],
                'phone_store'       =>    $faker->phoneNumber,
                'img_store'         =>      'store'.$i,
                'state_store'       =>1
            ]);
        }

        DB::table('store')->insert($arr);
    }
}
