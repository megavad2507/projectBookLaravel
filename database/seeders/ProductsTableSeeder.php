<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            [
                'name' => 'iPhone X 64GB',
                'code' => 'iphone_x_64',
                'description' => 'Отличный продвинутый телефон с памятью на 64 gb',
                'category_id' => 1,
                'picture' => 'products/iphone_x.jpeg',
                'hot' => rand(0,1),
                'new' => rand(0,1),
                'sale' => rand(0,1),
            ],
            [
                'name' => 'iPhone X 256GB',
                'code' => 'iphone_x_256',
                'description' => 'Отличный продвинутый телефон с памятью на 256 gb',
                'category_id' => 1,
                'picture' => 'products/iphone_x_silver.jpeg',
                'hot' => rand(0,1),
                'new' => rand(0,1),
                'sale' => rand(0,1),
            ],
            [
                'name' => 'HTC One S',
                'code' => 'htc_one_s',
                'description' => 'Зачем платить за лишнее? Легендарный HTC One S',
                'category_id' => 1,
                'picture' => 'products/htc_one_s.png',
                'hot' => rand(0,1),
                'new' => rand(0,1),
                'sale' => rand(0,1),
            ],
            [
                'name' => 'iPhone 5SE',
                'code' => 'iphone_5se',
                'description' => 'Отличный классический iPhone',
                'category_id' => 1,
                'picture' => 'products/iphone_5.jpeg',
                'hot' => rand(0,1),
                'new' => rand(0,1),
                'sale' => rand(0,1),
            ],
            [
                'name' => 'Наушники Beats Audio',
                'code' => 'beats_audio',
                'description' => 'Отличный звук от Dr. Dre',
                'category_id' => 2,
                'picture' => 'products/beats.jpeg',
                'hot' => rand(0,1),
                'new' => rand(0,1),
                'sale' => rand(0,1),
            ],
            [
                'name' => 'Камера GoPro',
                'code' => 'gopro',
                'description' => 'Снимай самые яркие моменты с помощью этой камеры',
                'category_id' => 2,
                'picture' => 'products/gopro.jpeg',
                'hot' => rand(0,1),
                'new' => rand(0,1),
                'sale' => rand(0,1),
            ],
            [
                'name' => 'Камера Panasonic HC-V770',
                'code' => 'panasonic_hc-v770',
                'description' => 'Для серьёзной видео съемки нужна серьёзная камера. Panasonic HC-V770 для этих целей лучший выбор!',
                'category_id' => 2,
                'picture' => 'products/video_panasonic.jpeg',
                'hot' => rand(0,1),
                'new' => rand(0,1),
                'sale' => rand(0,1),
            ],
            [
                'name' => 'Кофемашина DeLongi',
                'code' => 'delongi',
                'description' => 'Хорошее утро начинается с хорошего кофе!',
                'category_id' => 3,
                'picture' => 'products/delongi.jpeg',
                'hot' => rand(0,1),
                'new' => rand(0,1),
                'sale' => rand(0,1),
            ],
            [
                'name' => 'Холодильник Haier',
                'code' => 'haier',
                'description' => 'Для большой семьи большой холодильник!',
                'category_id' => 3,
                'picture' => 'products/haier.jpeg',
                'hot' => rand(0,1),
                'new' => rand(0,1),
                'sale' => rand(0,1),
            ],
            [
                'name' => 'Блендер Moulinex',
                'code' => 'moulinex',
                'description' => 'Для самых смелых идей',
                'category_id' => 3,
                'picture' => 'products/moulinex.jpeg',
                'hot' => rand(0,1),
                'new' => rand(0,1),
                'sale' => rand(0,1),
            ],
            [
                'name' => 'Мясорубка Bosch',
                'code' => 'bosch',
                'description' => 'Любите домашние котлеты? Вам определенно стоит посмотреть на эту мясорубку!',
                'category_id' => 3,
                'picture' => 'products/bosch.jpeg',
                'hot' => rand(0,1),
                'new' => rand(0,1),
                'sale' => rand(0,1),
            ],
            [
                'name' => 'Samsung Galaxy J6',
                'code' => 'galaxy_j6',
                'description' => 'Описание galaxy J6',
                'category_id' => 1,
                'picture' => 'products/samsung_j6.jpeg',
                'hot' => rand(0,1),
                'new' => rand(0,1),
                'sale' => rand(0,1),
            ],
        ]);
    }
}
