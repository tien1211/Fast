<?php

use Illuminate\Database\Seeder;

class foodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $arr = [];
        $sandw = array('Sandwich nướng xúc xích và cá ngừ phô mai','Sandwich Xúc Xích & Chà Bông','Sandwich Gà Nướng Cay','Sandwich Bò & Trứng','Sandwich Cá Ngừ Trứng','Sandwich Salad Gà','Sandwich Salad Cá Ngừ','Sandwich Thịt Nguội Phomai & Salad');
        $drink = array('Nước suối','Trà đào','Pepsi','Trà Sữa Thái Xanh Thạch Nha Đam','Ca Cao Sữa Đá','7Up','Mirinda');
        $desert = array('Kem dâu','Kem socola','Kem việt quất','Kem tươi','Bánh Pie Nhân Xoài Đào','Bánh Pie Nhân Đào','Bánh Pie Nhân Khoai Môn');
        $ff     = array('Khoai Tây Chiên','Khoai Tây Lắc Vị BBQ','Khoai Tây Lắc Vị Bơ');
        $salad  = array('Salad Bắp Cải & Thanh Cua','Salad Gà','Salad Cá Ngừ');
        $combo  = array('01 MIẾNG GÀ GIÒN VUI VẺ + 01 MỲ Ý SỐT BÒ BẰM + 01 NƯỚC NGỌT','03 MIẾNG GÀ GIÒN VUI VẺ + 01 MỲ Ý SỐT BÒ BẰM + 01 KHOAI TÂY (VỪA) + 02 NƯỚC NGỌT','3 MIẾNG GÀ GIÒN VUI VẺ + 1 MIẾNG GÀ SỐT CAY + 2 MỲ Ý SỐT BÒ BẰM + 2 KHOAI TÂY');
        $faker = Faker\Factory::create('vi_vn');
        $pric_sw   = $faker->numberBetween($min = 30000,$max = 40000);
        $pric_dr   = $faker->numberBetween($min = 15000,$max = 30000);
        $pric_cb   = $faker->numberBetween($min = 150000,$max = 300000);

        for($i=0;$i<count($sandw);$i++){
            array_push($arr,[
                'id_cate'       =>  1,
                'id_dis'        =>  $faker->numberBetween($min=1,$max=5),
                'name_food'     =>  $sandw[$i],
                'desc_food'     =>  '',
                'price_food'    =>  $pric_sw,
                'preprice_food' =>  $pric_sw - 3000,
                'state_food'    =>  1
            ]);
        }

        for($j=0;$j<count($drink);$j++){
            array_push($arr,[
                'id_cate'       =>  2,
                'id_dis'        =>  $faker->numberBetween($min=1,$max=5),
                'name_food'     =>  $drink[$j],
                'desc_food'     =>  '',
                'price_food'    =>  $pric_dr,
                'preprice_food' =>  $pric_dr - 3000,
                'state_food'    =>  1
            ]);
        }


        for($k=0;$k<count($desert);$k++){
            array_push($arr,[
                'id_cate'       =>  3,
                'id_dis'        =>  $faker->numberBetween($min=1,$max=5),
                'name_food'     =>  $desert[$k],
                'desc_food'     =>  '',
                'price_food'    =>  $pric_dr,
                'preprice_food' =>  $pric_dr - 3000,
                'state_food'    =>  1
            ]);
        }
        
        
        for($l=0;$l<count($ff);$l++){
            array_push($arr,[
                'id_cate'       =>  4,
                'id_dis'        =>  $faker->numberBetween($min=1,$max=5),
                'name_food'     =>  $ff[$l],
                'desc_food'     =>  '',
                'price_food'    =>  $pric_dr,
                'preprice_food' =>  $pric_dr - 3000,
                'state_food'    =>  1
            ]);
        }
        for($v=0;$v<count($salad);$v++){
            array_push($arr,[
                'id_cate'       =>  5,
                'id_dis'        =>  $faker->numberBetween($min=1,$max=5),
                'name_food'     =>  $salad[$v],
                'desc_food'     =>  '',
                'price_food'    =>  $pric_dr,
                'preprice_food' =>  $pric_dr - 3000,
                'state_food'    =>  1
            ]);
        }
        for($cb=0;$cb<count($combo);$cb++){
            array_push($arr,[
                'id_cate'       =>  6,
                'id_dis'        =>  $faker->numberBetween($min=1,$max=5),
                'name_food'     =>  $combo[$cb],
                'desc_food'     =>  '',
                'price_food'    =>  $pric_cb,
                'preprice_food' =>  $pric_cb - 15000,
                'state_food'    =>  1
            ]);
        }

        DB::table('food')->insert($arr);
    
    
    }
}
