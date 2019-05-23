<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Message
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $text
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @mixin \Eloquent
 */
class Message extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['name', 'email', 'text'];

    /**
     * @var array
     */
    public $sortable = ['name', 'email', 'created_at'];

}
