<?php

use Illuminate\Database\Seeder;

class billSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dateTime = new DateTime();
        $faker = Faker\Factory::create('vi_VN');
        $del = array(1,2);
        $arr = [];
        for ($i = 0; $i < 25;$i++){
            array_push($arr, [
                'id_emp'        =>  $faker->unique()->numberBetween($min = 1, $max = 34),
                'id_del'        =>  $faker->randomElements($del)[0],
                'date_bill'     =>  $dateTime->format('Y-m-d H:i:s'),
                'state_bill'    =>  1,
            ]);
        }
        DB::table('bill')->insert($arr);
    }
}
