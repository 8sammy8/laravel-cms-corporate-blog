<?php

use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $faker = Faker\Factory::create();

        $min = \Illuminate\Support\Facades\DB::table('menus')->where('parent_id', '>', 0)->min('id');
        $max = \Illuminate\Support\Facades\DB::table('menus')->where('parent_id', '>', 0)->max('id');

        for ($i = 1; $i < 50; $i++):

            $data = [
                'img' => ['desktop' => 'Portfolio0' . rand(1, 9) . '.png'],
                'keywords' => $faker->sentence(rand($min, $max), true),
                'meta_desc' => $faker->sentence(rand($min, $max), true),

            ];

            $post = new \App\Models\Post();

            $post->img = json_encode($data['img']);
            $post->keywords = $data['keywords'];
            $post->meta_desc = $data['meta_desc'];
            $post->user_id = 1;
            $post->menu_id = rand($min, $max);

            $post->save();

            $dataLangs = [
                [
                    'lang' => 'en',
                    'title' => $faker->sentence($min, true),
                    'text' => $faker->text(500),
                    'post_id' => $post->id
                ],
                [
                    'lang' => 'ru',
                    'title' => $faker->sentence($min, true),
                    'text' => $faker->text(500),
                    'post_id' => $post->id
                ]
            ];

            \Illuminate\Support\Facades\DB::table('posts_langs')->insert($dataLangs);

        endfor;
    }
}
