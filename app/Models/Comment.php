<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Comment
 *
 * @property int $id
 * @property string $text
 * @property string|null $name
 * @property string|null $email
 * @property int|null $parent_id
 * @property int|null $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $post_id
 * @property int|null $user_id
 * @property-read \App\Models\Post $post
 * @property-read \App\Models\User|null $user
 * @mixin \Eloquent
 */
class Comment extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['text', 'name', 'email', 'parent_id', 'post_id', 'user_id', 'status'];

    /**
     * @var array
     */
    public $sortable = ['name', 'email', 'status', 'post_id', 'user_id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function post()
    {
        return $this->belongsTo('App\Models\Post');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    /**
     * @param $value
     * @return string
     */
    public function getNameAttribute($value)
    {
        return ($value) ? $value : trans('models.comment_default_name');
    }

}
