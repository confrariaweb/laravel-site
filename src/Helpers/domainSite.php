<?php
if (!function_exists('domain_site')) {
    function domain_site()
    {

        $domain = str_replace('www.', '', parse_url(url()->current())['host']);
        $name_cache = '_domain_site_' . str_replace('.', '', $domain);
        $domain_site = Cache::remember($name_cache, 720, function () use ($domain) {
            return DB::table('sites')
                ->select('sites.*')
                ->Join('site_domains', function ($join) use ($domain) {
                    $join->on('sites.id', '=', 'site_domains.site_id')
                        ->where('site_domains.domain', $domain);
                })->first();
        });
        return $domain_site;

    }
}