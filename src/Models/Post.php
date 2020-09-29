<?php

namespace Confrariaweb\Site\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

    protected $table = 'site_posts';

    public function sites()
    {
        return $this->belongsToMany('Confrariaweb\Site\Models\Site');
    }
    
    public function options()
    {
        return $this->belongsToMany('Confrariaweb\Option\Models\Option');
    }
}
