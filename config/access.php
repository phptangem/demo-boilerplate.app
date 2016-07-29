<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/7/21
 * Time: 9:14
 */

return [
    /*
     * PermissionGroup model used by Access to create permission groups
     * Update the group if it is in a different namespace.
     */
    'group'=>App\Models\Access\Permission\PermissionGroup::class,
    /*
     * assigned_roles table used by access to save assigned roles to the database
     */
    'assigned_roles_table'=>'assigned_roles',
    /*
     *Permissions table used by access to save permissions to the database
     */
    'permission_group_table'=>'permission_groups',
    /*
     * Role model used by Access to create correct relations. Update the role if it is in a different namespace.
    */
    'role'=>App\Models\Access\Role\Role::class,
    /*
     *Roles table used by access to save roles to the database
     */
    'roles_table'=>'roles',
    /*
     * Configuration for roles
     */
    'roles'=>[
        /*
         * Whether a role must contain a permission or can be used standalone as a label
         */
        'role_must_contain_permission'=>true,
    ],
    /*
     *Permission model used by access to create correct relations
     * Update the permission if it is in a different namespace
     */
    'permission'=>App\Models\Access\Permission\Permission::class,

    /*
     * Permission table used by access to sav permission to database
     */
    'permissions_table'=>'permissions',
    /*
     * Table that specifies if one permission is dependent on another.
     * For example in order for  a user  to have the edit-user permission they also need the view-backend permission
     */
    'permission_dependencies_table'=>'permission_dependencies',

    /*
     *PermissionDependency model used by access  to create permissions dependencies
     *Update the dependency if it is in a different namespace.
     */
    'dependency'=>App\Models\Access\Permission\PermissionDependency::class,
    /*
     * Configuration for the user
     */
    'users'=>[
        //Whether or not the user has to confirm their email when signing up
        'confirm_email'=>true,
        //Whether or not the users email can be changed on the edit profile screen
        'change_email'=>false,
        //The role the user is assigned when they signed up from the frontend
        'default_role'=> 'User',
    ],
];