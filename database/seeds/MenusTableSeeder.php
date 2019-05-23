<?php

use Illuminate\Database\Seeder;

class MenusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data[] = ['path'=> 'service'];
        $data[] = ['path'=> 'portfolio'];
        $data[] = ['path'=> 'about'];
        $data[] = ['path'=> 'clients'];
        $data[] = ['path'=> 'price'];
        $data[] = ['path'=> 'blog'];
        $data[] = ['path'=> 'php'];
        $data[] = ['path'=> 'laravel'];
        $data[] = ['path'=> 'contact'];

        foreach ($data as $key => $item):
            $menu = new \App\Models\Menu();

            $menu->parent_id =  (isset($parent_id)) ? $parent_id : null;
            $menu->sort =  ++$key;
            $menu->path =  $item['path'];
            $menu->save();

            $parent_id = ($item['path'] == 'blog' || $item['path'] == 'php') ? $menu->id : null;
            $dataLangs[] = [
                [
                    'lang'=>'en',
                    'title'=>'service',
                    'menu_id'=>$menu->id
                ],
                [
                    'lang'=>'ru',
                    'title'=>'серсив',
                    'menu_id'=>$menu->id
                ]
            ];
            $dataLangs[] = [
                [
                    'lang'=>'en',
                    'title'=>'portfolio',
                    'menu_id'=>$menu->id
                ],
                [
                    'lang'=>'ru',
                    'title'=>'портфолио',
                    'menu_id'=>$menu->id
                ]
            ];
            $dataLangs[] = [
                [
                    'lang'=>'en',
                    'title'=>'about',
                    'menu_id'=>$menu->id
                ],
                [
                    'lang'=>'ru',
                    'title'=>'о нас',
                    'menu_id'=>$menu->id
                ]
            ];
            $dataLangs[] = [
                [
                    'lang'=>'en',
                    'title'=>'clients',
                    'menu_id'=>$menu->id
                ],
                [
                    'lang'=>'ru',
                    'title'=>'клиенты',
                    'menu_id'=>$menu->id
                ]
            ];
            $dataLangs[] = [
                [
                    'lang'=>'en',
                    'title'=>'price',
                    'menu_id'=>$menu->id
                ],
                [
                    'lang'=>'ru',
                    'title'=>'цена',
                    'menu_id'=>$menu->id
                ]
            ];
            $dataLangs[] = [
                [
                    'lang'=>'en',
                    'title'=>'blog',
                    'menu_id'=>$menu->id
                ],
                [
                    'lang'=>'ru',
                    'title'=>'блог',
                    'menu_id'=>$menu->id
                ]
            ];
            $dataLangs[] = [
                [
                    'lang'=>'en',
                    'title'=>'contact',
                    'menu_id'=>$menu->id
                ],
                [
                    'lang'=>'ru',
                    'title'=>'контакты',
                    'menu_id'=>$menu->id
                ]
            ];


            \Illuminate\Support\Facades\DB::table('menus_langs')->insert($dataLangs[$key]);

        endforeach;
    }
}
