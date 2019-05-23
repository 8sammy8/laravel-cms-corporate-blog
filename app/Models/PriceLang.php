<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\PriceLang
 *
 * @property int $id
 * @property string $lang
 * @property string $title
 * @property mixed $bonus
 * @property mixed $options
 * @property int $price_id
 * @property-read \App\Models\Price $price
 * @mixin \Eloquent
 */
class PriceLang extends Model
{
    /**
     * @var string
     */
    protected $table = 'prices_langs';

    /**
     * @var array
     */
    protected $fillable = ['lang', 'title', 'bonus', 'options', 'price_id'];

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function price()
    {
        return $this->belongsTo('App\Models\Price');
    }

    /**
     * @param $value
     * @return mixed
     */
    public function getBonusAttribute($value)
    {
        return json_decode($value);
    }

    /**
     * @param $value
     * @return mixed
     */
    public function getOptionsAttribute($value)
    {
        return json_decode($value);
    }
}
