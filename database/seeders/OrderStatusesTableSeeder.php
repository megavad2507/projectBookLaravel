<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderStatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('order_statuses')->insert([
            [
                'name' => 'Создан',
                'name_en' => 'Created',
                'sort' => 1
            ],
            [
                'name' => 'Доставляется',
                'name_en' => 'Delivering',
                'sort' => 2
            ],
            [
                'name' => 'Выполнен',
                'name_en' => 'Done',
                'sort' => 3
            ],
        ]);
    }
}
