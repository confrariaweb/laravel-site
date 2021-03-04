<?php

namespace ConfrariaWeb\Site\Models;

use ConfrariaWeb\Account\Traits\AccountTrait;
use ConfrariaWeb\File\Traits\FileTrait;
use ConfrariaWeb\Site\Scopes\AccountSiteScope;
use Illuminate\Database\Eloquent\Model;

class Site extends Model
{

    use AccountTrait;
    use FileTrait;

    protected $fillable = [
        'title', 'user_id', 'status', 'template_id', 'options'
    ];

    protected $casts = [
        'options' => 'collection',
    ];

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::addGlobalScope(new AccountSiteScope);
    }

    public function domains()
    {
        return $this->belongsToMany('ConfrariaWeb\Domain\Models\Domain');
    }

    public function template()
    {
        return $this->belongsTo('ConfrariaWeb\Template\Models\Template');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

}
