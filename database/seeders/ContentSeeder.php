<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $properties = [
            [
                'name' => 'Цвет',
                'name_en' => 'Color',
                'code' => 'color',
                'options' => [
                    [
                        'name' => 'Белый',
                        'name_en' => 'White',
                        'code' => 'white'
                    ],
                    [
                        'name' => 'Черный',
                        'name_en' => 'Black',
                        'code' => 'black'
                    ],
                    [
                        'name' => 'Серебристый',
                        'name_en' => 'Silver',
                        'code' => 'silver'
                    ],
                    [
                        'name' => 'Золотой',
                        'name_en' => 'Gold',
                        'code' => 'gold'
                    ],
                    [
                        'name' => 'Красный',
                        'name_en' => 'Red',
                        'code' => 'red'
                    ],
                    [
                        'name' => 'Синий',
                        'name_en' => 'Blue',
                        'code' => 'blue'
                    ],
                ],
            ],
            [
                'name' => 'Внутренняя память',
                'name_en' => 'Memory',
                'code' => 'memory',
                'options' => [
                    [
                        'name' => '32гб',
                        'name_en' => '32gb',
                        'code' => '32gb',
                    ],
                    [
                        'name' => '64гб',
                        'name_en' => '64gb',
                        'code' => '64gb'
                    ],
                    [
                        'name' => '128гб',
                        'name_en' => '128gb',
                        'code' => '128gb'
                    ],
                ],
            ],
        ];
        foreach ($properties as $property) {
            $property['created_at'] = Carbon::now();
            $property['updated_at'] = Carbon::now();
            $options = $property['options'];
            unset($property['options']);
            $propertyId = DB::table('properties')->insertGetId($property);

            foreach ($options as $option) {
                $option['created_at'] = Carbon::now();
                $option['updated_at'] = Carbon::now();
                $option['property_id'] = $propertyId;
                DB::table('property_options')->insert($option);
            }
        }
        $categories = [
            [
                'name' => 'Мобильные телефоны',
                'name_en' => 'Mobile phones',
                'code' => 'mobiles',
                'description' => 'В этом разделе вы найдёте самые популярные мобильные телефонамы по отличным ценам!',
                'description_en' => 'Mobile phones section with best prices for best popular phones!',
                'picture' => 'categories/mobiles.jpeg',
                'products' => [
                    [
                        'name' => 'iPhone X',
                        'name_en' => 'iPhone X',
                        'code' => 'iphone_x',
                        'description' => 'Отличный продвинутый телефон',
                        'description_en' => 'The best phone',
                        'picture' => 'products/iphone_x.jpeg',
                        'properties' => [
                            1, 2,
                        ],
                        'options' => [
                            [
                                1, 7,
                            ],
                            [
                                1, 8,
                            ],
                            [
                                2, 7,
                            ],
                            [
                                2, 8,
                            ],
                            [
                                3, 7,
                            ],
                            [
                                3, 8,
                            ],
                            [
                                4, 7,
                            ],
                            [
                                4, 8,
                            ],
                        ],
                    ],
                    [
                        'name' => 'iPhone XL',
                        'name_en' => 'iPhone XL',
                        'code' => 'iphone_xl',
                        'description' => 'Огромный продвинутый телефон',
                        'description_en' => 'The best huge phone',
                        'picture' => 'products/iphone_x_silver.jpeg',
                        'properties' => [
                            1, 2,
                        ],
                        'options' => [
                            [
                                1, 8,
                            ],
                            [
                                1, 9,
                            ],
                            [
                                2, 8,
                            ],
                            [
                                2, 9,
                            ],
                            [
                                3, 8,
                            ],
                            [
                                3, 9,
                            ],
                            [
                                4, 8,
                            ],
                            [
                                4, 9,
                            ],
                        ],
                    ],
                    [
                        'name' => 'HTC One S',
                        'name_en' => 'HTC One S',
                        'code' => 'htc_one_s',
                        'description' => 'Зачем платить за лишнее? Легендарный HTC One S',
                        'description_en' => 'Why do you need to pay more? Legendary HTC One S',
                        'picture' => 'products/htc_one_s.png',
                        'properties' => [
                            1, 2,
                        ],
                        'options' => [
                            [
                                2, 7,
                            ],
                            [
                                2, 8,
                            ],
                        ],
                    ],
                    [
                        'name' => 'iPhone 5SE',
                        'name_en' => 'iPhone 5SE',
                        'code' => 'iphone_5se',
                        'description' => 'Отличный классический iPhone',
                        'description_en' => 'The best classic iPhone',
                        'picture' => 'products/iphone_5.jpeg',
                        'properties' => [
                            1, 2,
                        ],
                        'options' => [
                            [
                                1, 7,
                            ],
                            [
                                1, 8,
                            ],
                            [
                                3, 7,
                            ],
                            [
                                3, 8,
                            ],
                            [
                                4, 7,
                            ],
                            [
                                4, 8,
                            ],
                        ],
                    ],
                    [
                        'name' => 'Samsung Galaxy J6',
                        'name_en' => 'Samsung Galaxy J6',
                        'code' => 'samsung_j6',
                        'description' => 'Современный телефон начального уровня',
                        'description_en' => 'Modern phone of basic level',
                        'picture' => 'products/samsung_j6.jpeg',
                        'properties' => [
                            1, 2,
                        ],
                        'options' => [
                            [
                                4, 7,
                            ],
                        ],
                    ],
                ]
            ],
            [
                'name' => 'Портативная техника',
                'name_en' => 'Portable',
                'code' => 'portable',
                'description' => 'Раздел с портативной техникой.',
                'description_en' => 'Section with portables.',
                'picture' => 'categories/portable.jpeg',
                'products' => [
                    [
                        'name' => 'Наушники Beats Audio',
                        'name_en' => 'Headphones Beats Audio',
                        'code' => 'beats_audio',
                        'description' => 'Отличный звук от Dr. Dre',
                        'description_en' => 'Great sound from Dr. Dre',
                        'picture' => 'products/beats.jpeg',
                        'properties' => [
                            1,
                        ],
                        'options' => [
                            [
                                2,
                            ],
                            [
                                5,
                            ],
                            [
                                6,
                            ]
                        ],
                    ],
                    [
                        'name' => 'Камера GoPro',
                        'name_en' => 'Camera GoPro',
                        'code' => 'gopro',
                        'description' => 'Снимай самые яркие моменты с помощью этой камеры',
                        'description_en' => 'Capture the best moments of your life with that camera',
                        'picture' => 'products/gopro.jpeg',
                    ],
                    [
                        'name' => 'Камера Panasonic HC-V770',
                        'name_en' => 'Camera Panasonic HC-V770',
                        'code' => 'panasonic_hc-v770',
                        'description' => 'Для серьёзной видео съемки нужна серьёзная камера. Panasonic HC-V770 для этих целей лучший выбор!',
                        'description_en' => 'For serious video you need the profession camera. Panasonic HC-V770 is that you need!',
                        'picture' => 'products/video_panasonic.jpeg',
                    ],
                ],
            ],
            [
                'name' => 'Бытовая техника',
                'name_en' => 'Appliance',
                'code' => 'appliances',
                'description' => 'Раздел с бытовой техникой',
                'description_en' => 'Section with appliance',
                'picture' => 'categories/bytovaya.jpeg',
                'products' => [
                    [
                        'name' => 'Кофемашина DeLongi',
                        'name_en' => 'Coffee machine DeLongi',
                        'code' => 'delongi',
                        'description' => 'Хорошее утро начинается с хорошего кофе!',
                        'description_en' => 'Good morning starts with a good coffee!',
                        'picture' => 'products/delongi.jpeg',
                        'properties' => [
                            1,
                        ],
                        'options' => [
                            [
                                2,
                            ],
                            [
                                5,
                            ],
                            [
                                6,
                            ],
                        ],
                    ],
                    [
                        'name' => 'Холодильник Haier',
                        'name_en' => 'Refrigerator Haier',
                        'code' => 'haier',
                        'description' => 'Для большой семьи большой холодильник!',
                        'description_en' => 'The huge refrigerator for a big family!',
                        'picture' => 'products/haier.jpeg',
                        'properties' => [
                            1,
                        ],
                        'options' => [
                            [
                                1,
                            ],
                            [
                                2,
                            ],
                            [
                                3,
                            ]
                        ],
                    ],
                    [
                        'name' => 'Блендер Moulinex',
                        'name_en' => 'Blender Moulinex',
                        'code' => 'moulinex',
                        'description' => 'Для самых смелых идей',
                        'description_en' => 'For best ideas',
                        'picture' => 'products/moulinex.jpeg',


                    ],
                    [
                        'name' => 'Мясорубка Bosch',
                        'name_en' => 'Food processor Bosch',
                        'code' => 'bosch',
                        'description' => 'Любите домашние котлеты? Вам определенно стоит посмотреть на эту мясорубку!',
                        'description_en' => 'Do you like home cutlets? You need to see that combine!',
                        'picture' => 'products/bosch.jpeg',
                    ],
                ],
            ]
        ];
        foreach ($categories as $category) {
            $category['created_at'] = Carbon::now();
            $category['updated_at'] = Carbon::now();
            $products = $category['products'];
            unset($category['products']);
            $categoryId = DB::table('categories')->insertGetId($category);

            foreach ($products as $product) {
                $product['created_at'] = Carbon::now();
                $product['updated_at'] = Carbon::now();
                $product['hot'] = !boolval(rand(0, 3));
                $product['new'] = rand(0, 1);
                $product['sale'] = rand(0, 1);
                $product['category_id'] = $categoryId;

                if (isset($product['properties'])) {
                    $properties = $product['properties'];
                    unset($product['properties']);
                    $skusOptions = $product['options'];
                    unset($product['options']);
                }

                $productId = DB::table('products')->insertGetId($product);

                if (isset($properties)) {
                    foreach ($properties as $propertyId) {
                        DB::table('property_product')->insert([
                            'product_id'  => $productId,
                            'property_id' => $propertyId,
                            'created_at'  => Carbon::now(),
                            'updated_at'  => Carbon::now(),
                        ]);
                    }

                    foreach ($skusOptions as $skuOptions) {
                        $skuId = DB::table('skus')->insertGetId([
                            'product_id' => $productId,
                            'quantity'      => rand(1, 100),
                            'price'      => rand(5000, 100000),
                            'created_at' => Carbon::now(),
                            'updated_at' => Carbon::now(),
                        ]);

                        foreach ($skuOptions as $skuOption) {
                            $skuData['sku_id'] = $skuId;
                            $skuData['property_option_id'] = $skuOption;
                            $skuData['created_at'] = Carbon::now();
                            $skuData['updated_at'] = Carbon::now();

                            DB::table('sku_property_option')->insert($skuData);
                        }
                    }

                    unset($properties);
                } else {
                    DB::table('skus')->insert([
                        'product_id' => $productId,
                        'quantity'      => rand(1, 100),
                        'price'      => rand(5000, 100000),
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                    ]);
                }
            }
        }
    }
}
