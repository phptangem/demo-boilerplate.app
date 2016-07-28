<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/7/28
 * Time: 14:50
 */
namespace App\Services\Macros;

use App\Services\Macros\Traits\Dropdowns;
use Collective\Html\FormBuilder;

class Macros extends FormBuilder
{
    use Dropdowns;
}