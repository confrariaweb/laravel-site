<?php

namespace Confrariaweb\Site\Models;

use Illuminate\Database\Eloquent\Model;

class Domain extends Model
{
    protected $table = 'site_domains';

    protected $fillable = [
        'domain', 'site_id'
    ];
    
    public function site()
    {
        return $this->belongsTo('App\Site');
    }
}
