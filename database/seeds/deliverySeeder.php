<?php

use Illuminate\Database\Seeder;

class deliverySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    
    // 3 Đã xác nhận:  Đơn hàng đã được xác nhận thành công (khách hàng có mua hàng).
    
    // 9 Đang chuyển:  Đơn hàng đang được chuyển đi cho khách hàng.
    // 10 Thành công:  Đơn hàng đã được giao thành công cho khách hàng.
    // 11 Thất bại:  Đơn hàng chưa giao được cho khách hàng. (Có thể vì khách hàng bận, đi vắng, khách hẹn lại thời điểm khác giao hàng...)
    // 12 Khách hủy:  Khách hàng hủy không lấy hàng nữa. Xem thêm tại đây.
     
    public function run()
    {
       $arr = [
        ['state_del' => 'Đã xác nhận'],
        ['state_del' => 'Đang chuyển'],
        ['state_del' => 'Thành công'],
        ['state_del' => 'Thất bại'],
        ['state_del' => 'Khách hủy'],
    ];
      
    DB::table('delivery')->insert($arr);
    }
}
