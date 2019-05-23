<?php

use Illuminate\Database\Seeder;

class PortfoliosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        for ($i = 1; $i < 10; $i++):
            $data = [
                'title' => 'UzLink website',
                'customer' => 'MCHJ UzLink',
                'skills' => 'HTML5, Laravel, MySql',
                'site' => 'https:://uzlink.uz',
                'img' => ['desktop' => 'Portfolio0' . $i . '.png'],
            ];

            $portfolio = new \App\Models\Portfolio();

            $portfolio->title = $data['title'];
            $portfolio->customer = $data['customer'];
            $portfolio->skills = $data['skills'];
            $portfolio->site = $data['site'];
            $portfolio->img = json_encode($data['img']);
            $portfolio->filter_id = rand(1, 3);
            $portfolio->sort = rand(1, 9);
            $portfolio->save();

            $dataLangs = [
                [
                    'lang' => 'en',
                    'text' => 'Welcome to Uzlink website',
                    'portfolio_id' => $portfolio->id
                ],
                [
                    'lang' => 'ru',
                    'text' => 'Добро пожаловать на сайт Uzlink',
                    'portfolio_id' => $portfolio->id
                ]
            ];

            \Illuminate\Support\Facades\DB::table('portfolios_langs')->insert($dataLangs);

        endfor;
    }
}
