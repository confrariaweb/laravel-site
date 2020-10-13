<?php

if (!function_exists('domain_template_package')) {
    function domain_template_package($d = null)
    {
        $domain = isset($d) ? $d : parse_url(url()->current())['host'];
        return DB::table('templates')
            ->select('templates.package')
            ->join('sites', 'templates.id', '=', 'sites.template_id')
            ->join('domains', function ($join) use ($domain) {
                $join->on('sites.id', '=', 'domains.site_id')
                    ->where('domains.domain', $domain);
            })->first()->package;
    }
}