<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);


        $this->call(discountSeeder::class);

        $this->call(addressSeeder::class);
        $this->call(categorySeeder::class);
        $this->call(deliverySeeder::class);
        $this->call(empSeeder::class);
        $this->call(storeSeeder::class);
        $this->call(foodSeeder::class);
        $this->call(foodstoreSeeder::class);
        $this->call(imgSeeder::class);

        // $this->call(billSeeder::class);
        // $this->call(billdetailSeeder::class);
        

    }
}
