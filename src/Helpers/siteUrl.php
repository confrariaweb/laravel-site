<?php
if (!function_exists('site_url')) {
    function site_url($cacheName = false)
    {
        $url = str_replace('www.', '', parse_url(url()->current())['host']);
        if($cacheName){
            $url = '_' . $cacheName . '_' . str_replace('.', '', $url);
        }
        return $url;
    }
}