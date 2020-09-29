<?php

if (!function_exists('site_configuration')) {
    function site_configuration($site_id, $item, $options = [], $default = null){

        $account = DB::table('accounts')
            ->select('accounts.id')
            ->Join('sites', 'accounts.id', '=', 'sites.account_id')
            ->where('sites.id', $site_id)
            ->first();

        $site_configurations = DB::table('sites')
            ->select('site_configurations.value')
            ->Join('site_configurations', function($join) use($item){
                $join->on('sites.id', '=', 'site_configurations.site_id')
                    ->where('site_configurations.field', $item);
            })
            ->where('sites.id', $site_id)
            ->first();
            $conf = isset($site_configurations)? $site_configurations->value : null;
        if(isset($options['type']) && $options['type'] == 'file' && isset($conf)){
            $path = isset($options['path'])? '/' . $options['path'] . '/' : '/';
            $conf = asset('storage/accounts/' . $account->id . $path . $conf);
        }

        return isset($conf)? $conf : $default;
    }
}