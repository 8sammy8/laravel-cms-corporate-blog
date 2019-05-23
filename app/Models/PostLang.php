<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\PostLang
 *
 * @property int $id
 * @property string $lang
 * @property string $title
 * @property string $text
 * @property int $post_id
 * @mixin \Eloquent
 */
class PostLang extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'posts_langs';

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = ['lang', 'title', 'text', 'post_id'];
}
