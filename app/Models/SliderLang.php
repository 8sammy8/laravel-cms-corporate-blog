<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\SliderLang
 *
 * @property int $id
 * @property string $lang
 * @property string $first_title
 * @property string $second_title
 * @property string $desc
 * @property int $slider_id
 * @property-read \App\Models\Slider $slider
 * @mixin \Eloquent
 */
class SliderLang extends Model
{
    /**
     * @var string
     */
    protected $table = 'sliders_langs';

    /**
     * @var array
     */
    protected $fillable = ['lang', 'first_title', 'second_title', 'desc', 'slider_id'];

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function slider()
    {
        return $this->belongsTo('App\Models\Slider');
    }
}
