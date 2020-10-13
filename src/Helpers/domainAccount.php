<?php
if (!function_exists('domain_account')) {

    function domain_account()
    {
        $domain = str_replace('www.', '', parse_url(url()->current())['host']);
        $name_cache = '_domain_account_' . str_replace('.', '', $domain);
        $domain_account = Cache::remember($name_cache, 720, function () use ($domain) {
            return DB::table('accounts')
                ->select('accounts.*')
                ->Join('sites', function ($join) {
                    $join->on('accounts.id', '=', 'sites.account_id');
                })->Join('domains', function ($join) use ($domain) {
                    $join->on('sites.id', '=', 'domains.site_id')
                        ->where('domains.domain', $domain);
                })->first();
        });
        return $domain_account;
    }
}