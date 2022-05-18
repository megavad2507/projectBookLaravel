<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BannersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('banners')->insert([
            [
                'title' => 'Открытие магазина!',
                'title_en' => 'Shop open!',
                'description' => 'Наш магазин открылся',
                'description_en' => 'Our shop is opened',
                'button_text' => 'За покупками',
                'button_href' => '/catalog/categories/',
                'button_text_en' => 'To shopping',
                'picture' => '/banners/first.jpg'
            ],
            [
                'title' => 'Лучшие цены!',
                'title_en' => 'Best prices!',
                'description' => 'У нас в магазине только честные и справедливые цены!',
                'description_en' => 'We have only honest and fair prices in our store!',
                'button_text' => 'За покупками',
                'button_href' => '/catalog/categories/',
                'button_text_en' => 'To shopping',
                'picture' => '/banners/second.jpg'
            ],
        ]);
    }
}
