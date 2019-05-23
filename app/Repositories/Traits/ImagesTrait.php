<?php

namespace App\Repositories\Traits;

use Intervention\Image\Facades\Image;

trait ImagesTrait
{
    private $oldImg = false;

    /**
     * @param \Illuminate\Http\Request $request
     * @return array|bool
     */
    protected function fillImg($request, $prefix)
    {
        if($request->hasFile('img')){
            $image = $request->file('img');
            if($image->isValid() && str_plural($prefix) != null){
                $str = uniqid();

                $obj = new \stdClass();

                $img = Image::make($image);

                foreach (config('img.' . str_plural($prefix)) as $side => $size){

                    $obj->$side = $side . $str . '.jpg';

                    $img->fit($size['width'], $size['height'])
                        ->save(public_path().'/'.config('img.' . str_singular($prefix)) . '/' . $side . $str . '.jpg');
                }
                $this->model->img = json_encode($obj);

                return true;
            }
            return ['error' => trans('rep.images_trait_fill_img_error')];
        }
        return true;
    }

    /**
     * @param string $prefix
     */
    protected function oldImgUnlink($prefix)
    {
        if ($this->oldImg) {
            foreach (json_decode($this->oldImg) as $side => $file) {
                if (file_exists(public_path() . '/' . config('img.' . str_singular($prefix)) . '/' . $file)) {
                    unlink(public_path() . '/' . config('img.' . str_singular($prefix)) . '/' . $file);
                }
            }
        }
    }
}