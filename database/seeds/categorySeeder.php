<?php

use Illuminate\Database\Seeder;

class categorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $arr = [];
        $cate = array('Sandwich','Nước giải khát','Tráng miệng','Thức ăn nhanh','Salad','Compo');
        $cate1=count($cate);
        for($i = 0; $i< $cate1; $i++){
            array_push($arr, [
                'name_cate'=> $cate[$i],
                'img_cate'  => 'cate'.$i,
                'state_cate' => 1,
                ]);
        }
        DB::table('category')->insert($arr);
    }
}
