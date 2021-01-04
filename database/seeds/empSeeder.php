<?php

use Illuminate\Database\Seeder;

class empSeeder extends Seeder
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
        $gender = array(0,1);
        $per = array(0,1,2);
        $state = array(0,1);
        
        array_push($arr,[
            'username'      => 'tien1211',
            'password'      => bcrypt('123'),
            'name_emp'      => 'Hong Anh Tien',
            'birth_emp'     => '1998-11-12',
            'gender_emp'    => 0,
            'per_emp'    => 0,
            'state_emp'    => 1,
        ]);
        array_push($arr,[
            'username'      => 'anhtien',
            'password'      => bcrypt('123'),
            'name_emp'      => 'Hong Anh Tien',
            'birth_emp'     => '1998-11-12',
            'gender_emp'    => 0,
            'per_emp'    => 1,
            'state_emp'    => 1,
        ]);

        for($i = 0;$i<=40;$i++){
            array_push($arr,[
            'username'      => $faker->username,
            'password'      => bcrypt('123'),
            'name_emp'      => $faker->name,
            'birth_emp'     => $faker->date($format = 'Y-m-d', $max = '2002-01-01',$min='1985-01-01'),
            'gender_emp'    => $faker->randomElements($gender)[0],
            'per_emp'    => $faker->randomElements($per)[0],
            'state_emp'    => $faker->randomElements($state)[0],

            ]);
        }

        DB::table('emp')->insert($arr);
    }
}
