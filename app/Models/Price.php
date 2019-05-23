<?php

namespace App\Models;

use Illuminate\Support\Facades\App;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Price
 *
 * @property int $id
 * @property float $price
 * @property int $sort
 * @property int $filter_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\FilterLang $filterLang
 * @property-read \App\Models\PriceLang $priceLang
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\PriceLang[] $priceLangs
 * @mixin \Eloquent
 */
class Price extends Model
{
    const DEFAULT_SORT_NUMBER = 1;
    /**
     * @var string
     */
    protected $table = 'prices';

    /**
     * @var array
     */
    protected $fillable = ['price', 'sort', 'filter_id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function priceLang()
    {
        return $this->hasOne('App\Models\PriceLang')->where('lang', App::getLocale());
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function priceLangs()
    {
        return $this->hasMany('App\Models\PriceLang');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function filterLang()
    {
        return $this->hasOne('App\Models\FilterLang', 'filter_id', 'filter_id')->where('lang', App::getLocale());
    }

    /**
     * @param $value
     */
    public function setSortAttribute($value)
    {
        $this->attributes['sort'] = empty($value) ? self::DEFAULT_SORT_NUMBER : $value;
    }
}
