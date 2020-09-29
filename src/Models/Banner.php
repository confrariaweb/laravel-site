<?php

namespace Confrariaweb\Site\Models;

use Illuminate\Database\Eloquent\Model;

class banner extends Model
{
    protected $table = 'site_banners';

    protected $fillable = [
        'site_id', 'file', 'options'
    ];
    
    public function site()
    {
        return $this->belongsTo('App\Site');
    }
}
