<?php

if (!function_exists('domain_template')) {

    function domain_template($d = null)
    {
        $domain = isset($d) ? $d : parse_url(url()->current())['host'];
        return DB::table('templates')
            ->select('templates.*')
            ->join('sites', 'templates.id', '=', 'sites.template_id')
            ->join('site_domains', function ($join) use ($domain) {
                $join->on('sites.id', '=', 'site_domains.site_id')
                    ->where('site_domains.domain', $domain);
            })->first();
    }

}