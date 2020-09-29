<?php

namespace Confrariaweb\Site\Models;

use Illuminate\Database\Eloquent\Model;
//use App\Scopes\AccountScope;
use Illuminate\Database\Eloquent\Builder;

class Site extends Model
{
    protected $fillable = [
        'title', 'account_id', 'user_id', 'status', 'template_id', 'options'
    ];
    
    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();
        $withSite = [
            'accounts',
            'account',
            'domains',
            'users',
            'user',
            'template',
            'templates',
            'pages',
            'options'
        ];
        $account = domain_account();
        //static::addGlobalScope(new AccountScope);

        static::addGlobalScope('account', function (Builder $builder) use($account) {
            $builder->where('sites.account_id', $account->id);
        });
        /*
        static::addGlobalScope('withSite', function (Builder $builder) use ($withSite) {
            $builder->with($withSite);
        });
        */
    }
    
    public function accounts()
    {
        return $this->belongsToMany('Confrariaweb\Account\Models\Account');
    }
    
    public function account()
    {
        return $this->belongsTo('Confrariaweb\Account\Models\Account');
    }
    
    public function domains()
    {
        return $this->hasMany('Confrariaweb\Site\Models\Domain');
    }
    
    public function users()
    {
        return $this->belongsToMany('App\User');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }


    public function template()
    {
        return $this->belongsTo('Confrariaweb\Template\Models\Template', 'template_id');
    }
    
    public function templates()
    {
        return $this->belongsToMany('Confrariaweb\Template\Models\Template')->withPivot('options');
    }
    
    public function pages()
    {
        return $this->belongsToMany('Confrariaweb\Site\Models\Page');
    }

    public function options()
    {
        return $this->belongsToMany('Confrariaweb\Option\Models\Option', 'option_site', 'site_id', 'option_id');
    }
    
}
