<?php

namespace App\Models;

use Illuminate\Support\Facades\App;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Post
 *
 * @property int $id
 * @property mixed $img
 * @property string $keywords
 * @property string $meta_desc
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $user_id
 * @property int $menu_id
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Comment[] $comments
 * @property-read \App\Models\MenuLang $menuLang
 * @property-read \App\Models\PostLang $postLang
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\PostLang[] $postLangs
 * @property-read \App\Models\User $user
 * @mixin \Eloquent
 */
class Post extends Model
{
    use ImgMutator;

    /**
     * @var array
     */
    protected $fillable = ['img', 'keywords', 'meta_desc', 'user_id', 'menu_id'];

    /**
     * @var array
     */
    public $sortable = ['name', 'email', 'status', 'created_at', 'post_id', 'user_id', 'title'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function postLang()
    {
        return $this->hasOne(PostLang::class)->where('lang', App::getLocale());
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function postLangs()
    {
        return $this->hasMany(PostLang::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function menuLang()
    {
        return $this->hasOne(MenuLang::class, 'menu_id', 'menu_id')->where('lang', App::getLocale());
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

}
