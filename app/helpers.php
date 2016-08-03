<?php
if(!function_exists('app_name')){
    /**
     * Helper to grab the Application name
     *
     * return mixed
     */
    function app_name()
    {
        return config('app.name');
    }
}
if(!function_exists('access')){
    /**
     * Access (lol) the Access::facade as a simple function
     */
    function access()
    {
        return app('access');
    }
}
if(! function_exists('gravatar')){
    /**
     * Access the gravatar  helper
     * @return \Illuminate\Foundation\Application|mixed
     */
    function gravatar()
    {
        return app('gravatar');
    }
}

if(! function_exists('getLanguageBlock')){
    function getLanguageBlock($view, $data = [])
    {
        $components = explode('lang', $view);
        $current = $components[0].'lang.'.app()->getLocale().$components[1];
        $fallback  = $components[0].'lang.'.getFallbackLocale().$components[1];
        if(view()->exists($current)){
            return view($current, $data);
        }else{
            return view($fallback, $data);
        }
    }
}

if(! function_exists('getFallbackLocale')){
    function getFallbackLocale()
    {
        return config('app.fallback_locale');
    }
}