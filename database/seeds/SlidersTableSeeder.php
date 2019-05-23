<?php

use Illuminate\Database\Seeder;
use App\Models\Slider;

class SlidersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data[] = [
            'path'=> 'test1',
            'sort'=> 1,
            'img'=> ['desktop' => 'Slider01.png']
        ];
        $data[] = [
            'path'=> 'test2',
            'sort'=> 2,
            'img'=> ['desktop' => 'Slider02.png']
        ];
        $data[] = [
            'path'=> 'test3',
            'sort'=> 3,
            'img'=> ['desktop' => 'Slider03.png']
        ];

        foreach ($data as $key => $item):
        $slider = new Slider();

        $slider->path = $item['path'];
        $slider->sort =  $item['sort'];
        $slider->img = json_encode($item['img']);
        $slider->save();

        $dataLangs[] = [
            [
                'lang'=>'en',
                'first_title'=>'Welcome to Uzlink website',
                'second_title'=>'Clean & responsive',
                'desc'=>'When she reached the first hills of the Italic Mountains, she had a last view back on the skyline of
                    her hometown Bookmarksgrove, the headline of Alphabet Village and the subline of her own road, the
                    Line Lane.',
                'slider_id'=>$slider->id
            ],
            [
                'lang'=>'ru',
                'first_title'=>'Добро пожаловать на сайт Uzlink',
                'second_title'=>'Clean & responsive',
                'desc'=>'When she reached the first hills of the Italic Mountains, she had a last view back on the skyline of
                    her hometown Bookmarksgrove, the headline of Alphabet Village and the subline of her own road, the
                    Line Lane.',
                'slider_id'=>$slider->id
            ]
        ];

            $dataLangs[] = [
                [
                    'lang'=>'en',
                    'first_title'=>'Easy management',
                    'second_title'=>'Easy to use',
                    'desc'=>'Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live
                    the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large
                    language ocean.',
                    'slider_id'=>$slider->id
                ],
                [
                    'lang'=>'ru',
                    'first_title'=>'Легко в использовании',
                    'second_title'=>'Clean & responsive',
                    'desc'=>'When she reached the first hills of the Italic Mountains, she had a last view back on the skyline of
                    her hometown Bookmarksgrove, the headline of Alphabet Village and the subline of her own road, the
                    Line Lane.',
                    'slider_id'=>$slider->id
                ]
            ];

            $dataLangs[] = [
                [
                    'lang'=>'en',
                    'first_title'=>'Revolution',
                    'second_title'=>'Customizable',
                    'desc'=>'A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a
                    paradisematic country, in which roasted parts of sentences fly into your mouth.',
                    'slider_id'=>$slider->id
                ],
                [
                    'lang'=>'ru',
                    'first_title'=>'Добро пожаловать на сайт Uzlink',
                    'second_title'=>'Clean & responsive',
                    'desc'=>'When she reached the first hills of the Italic Mountains, she had a last view back on the skyline of
                    her hometown Bookmarksgrove, the headline of Alphabet Village and the subline of her own road, the
                    Line Lane.',
                    'slider_id'=>$slider->id
                ]
            ];


        \Illuminate\Support\Facades\DB::table('sliders_langs')->insert($dataLangs[$key]);

        endforeach;

    }
}
