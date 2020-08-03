<?php

// asset_() works similler as asset() but for public inclusion!!!
if (! function_exists('asset_')) {
    function asset_($path = null, $default = null) {
        if (!preg_match('/\blocalhost:\b/', asset('/'))) return asset('/').'public/'.trim($path, '/');
        else return asset('/').trim($path, '/');
    }
}

if (! function_exists('base_url')) {
    function base_url() {
    	return URL::to('/');
    }
}

if (! function_exists('show_route')) {
    function show_route($model, $resource = null)
    {
        $resource = $resource ?? plural_from_model($model);

        return route("{$resource}.show", $model);
    }
}
