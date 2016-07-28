<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/7/22
 * Time: 14:48
 */
namespace App\Services\Access\Facades;

use Illuminate\Support\Facades\Facade;

class Access extends Facade
{
    /**
     * Get the registered name of component
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'access';
    }
}