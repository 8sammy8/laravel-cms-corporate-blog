<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\FilterLang
 *
 * @property int $id
 * @property string $lang
 * @property string $title
 * @property mixed $desc
 * @property int $filter_id
 * @property-read \App\Models\Filter $filter
 * @property-read \App\Models\Portfolio $portfolio
 * @mixin \Eloquent
 */
class FilterLang extends Model
{
    /**
     * @var string
     */
    protected $table = 'filters_langs';

    /**
     * @var array
     */
    protected $fillable = ['lang', 'title', 'desc', 'filter_id'];

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function filter()
    {
        return $this->belongsTo('App\Models\Filter');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function portfolio()
    {
        return $this->belongsTo('App\Models\Portfolio');
    }

    /**
     * @param $value
     */
    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = ucfirst($value);
    }

    /**
     * @param $value
     * @return mixed
     */
    public function getDescAttribute($value)
    {
        return json_decode($value);
    }
}
