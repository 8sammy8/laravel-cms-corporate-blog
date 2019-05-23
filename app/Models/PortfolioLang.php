<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\PortfolioLang
 *
 * @property int $id
 * @property string $lang
 * @property string $text
 * @property int $portfolio_id
 * @property-read \App\Models\Portfolio $portfolio
 * @mixin \Eloquent
 */
class PortfolioLang extends Model
{
    /**
     * @var string
     */
    protected $table = 'portfolios_langs';

    /**
     * @var array
     */
    protected $fillable = ['lang', 'text', 'portfolio_id'];

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function portfolio()
    {
        return $this->belongsTo('App\Models\Portfolio');
    }
}
