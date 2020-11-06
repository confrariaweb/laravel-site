<?php

namespace ConfrariaWeb\Site\Models;

use ConfrariaWeb\Account\Traits\AccountTrait;
use ConfrariaWeb\File\Traits\FileTrait;
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
