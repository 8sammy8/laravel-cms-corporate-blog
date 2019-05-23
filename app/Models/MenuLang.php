<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\MenuLang
 *
 * @property int $id
 * @property string $lang
 * @property string $title
 * @property int $menu_id
 * @property-read \App\Models\Menu $menu
 * @mixin \Eloquent
 */
class MenuLang extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['lang', 'title', 'menu_id'];

    /**
     * @var string
     */
    protected $table = 'menus_langs';

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function menu()
    {
        return $this->belongsTo('App\Models\Menu');
    }
}
