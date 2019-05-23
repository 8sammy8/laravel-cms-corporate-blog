<?php

namespace App\Models;

use Illuminate\Support\Facades\App;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Slider
 *
 * @property int $id
 * @property string $path
 * @property int $sort
 * @property mixed $img
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\SliderLang $sliderLang
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\SliderLang[] $sliderLangs
 * @mixin \Eloquent
 */
class Slider extends Model
{
    use ImgMutator;

    const DEFAULT_SORT_NUMBER = 1;

    /**
     * @var array
     */
    protected $fillable = ['path', 'sort', 'img'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function sliderLang()
    {
        return $this->hasOne('App\Models\SliderLang')->where('lang', App::getLocale());
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function sliderLangs()
    {
        return $this->hasMany('App\Models\SliderLang');
    }

    /**
     * @param $value
     * @return string
     */
    public function getPathAttribute($value)
    {
        (config('app.locale') == App::getLocale()) ? $locale = '' : $locale = DIRECTORY_SEPARATOR . App::getLocale();
        return $locale . ($value);
    }

    /**
     * @param $value
     */
    public function setSortAttribute($value)
    {
        $this->attributes['sort'] = empty($value) ? self::DEFAULT_SORT_NUMBER : $value;
    }
}
