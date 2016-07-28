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