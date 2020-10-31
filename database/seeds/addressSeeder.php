<?php

use Illuminate\Database\Seeder;

class addressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create('vi_VN');
        $arr = [];
        $gender = array('0','1');
        $quan   = array('Bình Thủy','Cái Răng','Ninh Kiều','Ô Môn','Thốt Nốt');

        for($i = 1 ; $i <= 30 ; $i ++){
            array_push($arr,[
            'number_address'            =>  $faker->numberBetween($min = 1, $max = 999),
            'street_address'            =>  $faker->streetName,
            'district_address'          =>  $faker->randomElements($quan)[0],
            'state_address'             =>  $faker->randomElements($gender)[0],
            ]);
        }
        DB::table('address')->insert($arr);





    }
}
