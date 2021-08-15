<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            [
                'name' => 'Мобильные телефоны',
                'code' => 'mobiles',
                'description' => 'Мобильное описание',
                'picture' => 'categories/mobiles.jpeg'
            ],
            [
                'name' => 'Портативная техника',
                'code' => 'portable',
                'description' => 'Описание портативной техники',
                'picture' => 'categories/portable.jpeg'
            ],
            [
                'name' => 'Бытовая техника',
                'code' => 'technique',
                'description' => 'Описание бытовой техники',
                'picture' => 'categories/bytovaya.jpeg'
            ]
        ]);
    }
}
