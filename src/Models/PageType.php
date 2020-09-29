<?php

namespace Confrariaweb\Site\Models;

use Illuminate\Database\Eloquent\Model;

class PageType extends Model
{

    protected $table = 'site_page_types';
    
    protected $fillable = [
        'title', 
        'slug', 
        'posts', 
        'status'
    ];
    
    public function accounts()
    {
        return $this->belongsToMany('Confrariaweb\Account\Models\Account');
    }
    
    public function plans()
    {
        return $this->belongsToMany('App\Plan');
    }
    
    public function sites()
    {
        return $this->belongsToMany('App\Site');
    }
    
    public function templates()
    {
        return $this->belongsToMany('App\Template');
    }
    
    public function options()
    {
        return $this->belongsToMany('Confrariaweb\Option\Models\Option')->withPivot('page', 'post');
    }
    
    public function pages()
    {
        return $this->hasMany('App\Page');
    }
}
