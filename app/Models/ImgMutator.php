<?php

namespace App\Models;


trait ImgMutator
{
    /**
     * @var bool
     */
    protected $imgOrigin = false;

    /**
     * @param $value
     * @return mixed
     */
    public function getImgAttribute($value)
    {
        if($this->isImgOrigin()){
            return $value;
        }
        $theme = config('theme.default');

        if (is_string($value) && is_object(json_decode($value)) && (json_last_error() == JSON_ERROR_NONE)) {
            $value = json_decode($value);
        }
        return $value->$theme;
    }

    /**
     * @return bool
     */
    public function isImgOrigin(): bool
    {
        return $this->imgOrigin;
    }

    /**
     * @param bool $imgOrigin
     */
    public function setImgOrigin(bool $imgOrigin): void
    {
        $this->imgOrigin = $imgOrigin;
    }

}