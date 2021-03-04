<?php

namespace ConfrariaWeb\Site\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Support\Str;

class AccountSiteScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     *
     * @param \Illuminate\Database\Eloquent\Builder $builder
     * @param \Illuminate\Database\Eloquent\Model $model
     * @return void
     */
    public function apply(Builder $builder, Model $model)
    {

        if(!app()->runningInConsole()) {
            $prefix = request()->route()->getPrefix();
            $when = Str::contains($prefix , 'dashboard') && existsAccount();
            $builder->when($when, function ($query) {
                return $query
                    ->join('account_site', function ($join) {
                        $join->on('sites.id', '=', 'account_site.site_id')
                            ->where('account_site.account_id', account()->id);
                    });
            }, function ($query) {
                return $query->whereNotNull('user_id');
            });
        }
    }
}