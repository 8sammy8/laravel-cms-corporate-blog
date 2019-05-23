<?php

namespace App\Models;

use Illuminate\Support\Facades\App;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Portfolio
 *
 * @property int $id
 * @property string $title
 * @property string $customer
 * @property string $skills
 * @property string|null $site
 * @property mixed $img
 * @property int $sort
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $filter_id
 * @property-read \App\Models\FilterLang $filterLang
 * @property-read \App\Models\PortfolioLang $portfolioLang
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\PortfolioLang[] $portfolioLangs
 * @mixin \Eloquent
 */
class Portfolio extends Model
{
    use ImgMutator;

    /**
     * @var array
     */
    protected $fillable = ['title', 'customer', 'skills', 'site', 'img', 'sort', 'filter_id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function portfolioLang()
    {
        return $this->hasOne('App\Models\PortfolioLang')->where('lang', App::getLocale());
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function portfolioLangs()
    {
        return $this->hasMany('App\Models\PortfolioLang');
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
        $this->attributes['sort'] = empty($value) ? 1 : $value;
    }

}
