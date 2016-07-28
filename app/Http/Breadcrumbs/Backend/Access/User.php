<?php
Breadcrumbs::register('admin.access.users.index',function($breadcrumbs){
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push(trans('labels.backend.access.users.management'), route('admin.access.users.index'));
});
Breadcrumbs::register('admin.access.users.edit',function($breadcrumbs,$id){
    $breadcrumbs->parent('admin.access.users.index');
    $breadcrumbs->push(trans('labels.backend.access.users.edit'), route('admin.access.users.edit', $id));
});
Breadcrumbs::register('admin.access.user.change-password',function($breadcrumbs,$id){
   $breadcrumbs->parent('admin.access.users.index');
   $breadcrumbs->push(trans('menus.backend.access.users.change-password'), route('admin.access.user.change-password', $id));
});