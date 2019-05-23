<?php

namespace App\Models;

use Illuminate\Support\Facades\App;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Menu
 *
 * @property int $id
 * @property string $path
 * @property int|null $parent_id
 * @property int $sort
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\MenuLang $menuLang
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\MenuLang[] $menuLangs
 * @property-read \App\Models\MenuLang $parent
 * @mixin \Eloquent
 */
class Menu extends Model
{
    const DEFAULT_SORT_NUMBER = 1;
    /**
     * @var array
     */
    protected $fillable = ['path', 'parent_id', 'sort'];

    /**
     * @var bool
     */
    protected $pathOrigin = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function menuLang()
    {
        return $this->hasOne('App\Models\MenuLang')->where('lang', App::getLocale());
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function menuLangs()
    {
        return $this->hasMany('App\Models\MenuLang');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function parent()
    {
        return $this->hasOne('App\Models\MenuLang', 'menu_id', 'parent_id');
    }

    /**
     * @return int|null
     */
    public function getParent_id()
    {
        return $this->parent_id;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param $value
     * @return \Illuminate\Contracts\Routing\UrlGenerator|string
     */
    public function getPathAttribute($value)
    {
        if(!$this->isPathOrigin()){
            (config('settings.locale_default') == App::getLocale()) ? $locale = '' : $locale = App::getLocale();

            if ($this->getParent_id() == null && $value == 'blog') {
                $value = url("{$locale}/blog");
            } elseif ($this->getParent_id() == null) {
                $value = url("{$locale}#{$value}");
            } else {
                $value = url("{$locale}/blog/cat-{$this->getId()}");
            }
        }
        return $value;
    }

    /**
     * @return bool
     */
    public function isPathOrigin(): bool
    {
        return $this->pathOrigin;
    }

    /**
     * @param bool $pathOrigin
     */
    public function setPathOrigin(bool $pathOrigin): void
    {
        $this->pathOrigin = $pathOrigin;
    }

    /**
     * @param $value
     */
    public function setSortAttribute($value)
    {
        $this->attributes['sort'] = empty($value) ? self::DEFAULT_SORT_NUMBER : $value;
    }
}
