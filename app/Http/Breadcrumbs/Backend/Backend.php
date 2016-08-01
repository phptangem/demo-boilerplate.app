<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/7/21
 * Time: 16:01
 */
Breadcrumbs::register('admin.dashboard', function($breadcrumbs){
    $breadcrumbs->push('Dashboard', route('admin.dashboard'));
});

require __DIR__.'/Access.php';
require __DIR__.'/LogViewer.php';