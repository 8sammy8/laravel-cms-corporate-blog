<?php

use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (\Route::getRoutes()->get() as $route){
            if(isset($route->action['as']) && strstr($route->action['as'], 'backend.')){
                $permissions[] = [
                    'name' => strstr($route->action['as'], 'backend.')
                ];
            }
        }
        \Illuminate\Support\Facades\DB::table('permissions')->insert($permissions);
    }
}
