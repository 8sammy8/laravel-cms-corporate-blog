<?php

use Illuminate\Database\Seeder;

class FiltersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data[] = [
            'sort'=> 1,
            'price'=> 50
        ];
        $data[] = [
            'sort'=> 2,
            'price'=> 100
        ];
        $data[] = [
            'sort'=> 3,
            'price'=> 150
        ];

        foreach ($data as $key => $item):
            $filter = new \App\Models\Filter();

            $filter->sort =  $item['sort'];
            $filter->price =  $item['price'];
            $filter->save();

            $dataLangs[] = [
                [
                    'lang'=>'en',
                    'title'=>'website',
                    'desc'=>json_encode([
                        'free setup',
                        '24/7 support',
                        'file storage'
                    ]),
                    'filter_id'=>$filter->id
                ],
                [
                    'lang'=>'ru',
                    'title'=>'веб-сайт',
                    'desc'=>json_encode([
                        'бесплатная установка',
                        '24/7 поддержка',
                        'файловое хранилище'
                    ]),
                    'filter_id'=>$filter->id
                ]
            ];

            $dataLangs[] = [
                [
                    'lang'=>'en',
                    'title'=>'seo',
                    'desc'=>json_encode([
                        'free setup',
                        '24/7 support',
                        'file storage'
                    ]),
                    'filter_id'=>$filter->id
                ],
                [
                    'lang'=>'ru',
                    'title'=>'поисковая оптимизация',
                    'desc'=>json_encode([
                        'бесплатная установка',
                        '24/7 поддержка',
                        'файловое хранилище'
                    ]),
                    'filter_id'=>$filter->id
                ]
            ];

            $dataLangs[] = [
                [
                    'lang'=>'en',
                    'title'=>'mobile application',
                    'desc'=>json_encode([
                        'free setup',
                        '24/7 support',
                        'file storage'
                    ]),
                    'filter_id'=>$filter->id
                ],
                [
                    'lang'=>'ru',
                    'title'=>'мобильное приложение',
                    'desc'=>json_encode([
                        'бесплатная установка',
                        '24/7 поддержка',
                        'файловое хранилище'
                    ]),
                    'filter_id'=>$filter->id
                ]
            ];


            \Illuminate\Support\Facades\DB::table('filters_langs')->insert($dataLangs[$key]);

        endforeach;

    }
}
