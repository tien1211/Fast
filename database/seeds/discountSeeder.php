<?php

use Illuminate\Database\Seeder;

class discountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $arr = [];
        $faker =    Faker\Factory::create('vi_vn');
        $name = array('Christmas','Mừng Xuân','2-9 Quốc Khách','Trung Thu','Quốc Tế Phụ Nữ');
        $count = count($name);
        $start = array('2020-12-09','2020-12-20','2020-08-25','2020-09-01','2020-10-10');
        $end = array('2020-12-14','2021-01-01','2020-09-02','2020-09-13','2020-10-20');
        
       


        array_push($arr,[
            'topic_dis'=> 'Không có khuyến mãi',
            'content_dis'=> 0,
            'start_dis' => null,
            'end_dis' => null,
        ]);


        for($i = 0 ;$i < $count;$i++){
            array_push($arr,[
                'topic_dis'         => $name[$i],
                'content_dis'       => $faker->numberBetween($min=1,$max=15), 
                'start_dis'         => $start[$i],
                'end_dis'           => $end[$i],
            ]);
        }
        DB::table('discount')->insert($arr);
    }
}
