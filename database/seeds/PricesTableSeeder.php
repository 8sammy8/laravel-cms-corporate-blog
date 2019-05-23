<?php

use Illuminate\Database\Seeder;

class PricesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        for ($i = 1; $i < 20; $i++):
            $price = new \App\Models\Price();

            $price->sort =  $i;
            $price->price =  rand(100, 1000);
            $price->filter_id =  rand(1, 3);
            $price->save();

            $dataLangs = [
                [
                    'lang'=>'en',
                    'title'=>'website',
                    'bonus'=>json_encode([
                        'free setup',
                        '24/7 support',
                        'file storage'
                    ]),
                    'options'=>json_encode([
                        'free setup',
                        '24/7 support',
                        'file storage'
                    ]),
                    'price_id'=>$price->id
                ],
                [
                    'lang'=>'ru',
                    'title'=>'веб-сайт',
                    'bonus'=>json_encode([
                        'бесплатная установка',
                        '24/7 поддержка',
                        'файловое хранилище'
                    ]),
                    'options'=>json_encode([
                        'бесплатная установка',
                        '24/7 поддержка',
                        'файловое хранилище'
                    ]),
                    'price_id'=>$price->id
                ]
            ];


            \Illuminate\Support\Facades\DB::table('prices_langs')->insert($dataLangs);

        endfor;
    }
}
