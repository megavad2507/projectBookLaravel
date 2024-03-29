<?php

namespace Database\Seeders;

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
        // \App\Models\User::factory(10)->create();
        $this->call(UsersTableSeeder::class);
        $this->call(CurrencySeeder::class);
        $this->call(ContentSeeder::class);
        $this->call(BannersSeeder::class);
        $this->call(OrderStatusesTableSeeder::class);
        $this->call(PaymentSeeder::class);
    }
}
