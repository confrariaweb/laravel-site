<?php

namespace Confrariaweb\Site\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{

    protected $table = 'site_pages';

    protected $fillable = [
        'account_id',
        'page_type_id',
        'site_id',
        'template_id',
        'user_id',
        'title',
        'slug',
        'content',
        'options',
        'status'
    ];

    public function account()
    {
        return $this->belongsTo('Confrariaweb\Account\Models\Account');
    }

    public function site()
    {
        return $this->belongsTo('Confrariaweb\Site\Models\Site');
    }

    public function sites()
    {
        return $this->belongsToMany('Confrariaweb\Site\Models\Site');
    }

    public function template()
    {
        return $this->belongsTo('Confrariaweb\Template\Models\Template');
    }

    public function type()
    {
        return $this->belongsTo('Confrariaweb\Site\Models\PageType', 'page_type_id');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
