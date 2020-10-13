<?php

if (!function_exists('pages')) {
    function pages($r = null){
        $pages = DB::table('site_pages')
                ->select('pages.*', 'page_types.slug as type_slug', 'page_types.title as type_title')
            ->Join('page_site', function($join){
                $join->on('pages.id', '=', 'page_site.page_id');
            })->Join('sites', function($join){
                $join->on('page_site.site_id', '=', 'sites.id');
            })->Join('domains', function($join){
                $join->on('sites.id', '=', 'domains.site_id')
                    ->where('domains.domain', parse_url(url()->current())['host']);
            })->Join('page_types', function($join){
                $join->on('pages.page_type_id', '=', 'page_types.id');
            })->Join('accounts', function($join){
                $join->on('pages.account_id', '=', 'accounts.id');
            })
            ->where(['pages.status' => 1])->get(); 
            $r['pages'] = $pages;
            foreach($pages as $p){
                $r['types'][$p->type_slug]['title'] = __($p->type_title);
                $r['types'][$p->type_slug]['pages'][] = $p;
            } 
        return $r;
    }
}