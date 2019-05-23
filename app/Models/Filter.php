<?php

namespace App\Models;

use Illuminate\Support\Facades\App;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Filter
 *
 * @property int $id
 * @property int $sort
 * @property int $price
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\FilterLang $filterLang
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\FilterLang[] $filterLangs
 * @property-read \App\Models\Portfolio $portfolios
 * @property-read \App\Models\Price $prices
 * @mixin \Eloquent
 */
class Filter extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['sort', 'price'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function filterLang()
    {
        return $this->hasOne('App\Models\FilterLang')->where('lang', App::getLocale());
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function filterLangs()
    {
        return $this->hasMany('App\Models\FilterLang');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function prices()
    {
        return $this->belongsTo('App\Models\Price', 'id', 'filter_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function portfolios()
    {
        return $this->belongsTo('App\Models\Portfolio','id', 'filter_id');
    }

    /**
     * @param $value
     */
    public function setSortAttribute($value)
    {
        $this->attributes['sort'] = empty($value) ? 1 : $value;
    }
}
