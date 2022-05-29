<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('payments')->insert([
            [
            'name' => 'Наличными при получении',
            'name_en' => 'In cash upon receipt'
            ],
            [
                'name' => 'Картой при получении',
                'name_en' => 'By card upon receipt'
            ],
        ]);
    }
}
