<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/7/21
 * Time: 13:47
 */
return [
    'backend'=>[
        'access'=>[
            'roles'=>[
                'create'=>'Create Role',
                'management'=>'Role Management',
                'edit'=>'Edit Role',
                'table'=>[
                    'role'=>'Role',
                    'permissions'=>'Permissions',
                    'management'=>'Role Management',
                    'number_of_users'=>'Number of Users',
                    'sort'=>'Sort',
                ],
            ],
            'permissions'=>[
                'create'=>'Create Permission',
                'edit'=>'Edit Permission',
                'group'=>'Group',
                'grouped_permissions'=>'Grouped Permissions',
                'groups'=>[
                    'create'=>'Create Group',
                    'edit'=>'Edit Group',
                    'table'=>[
                        'name'=>'Name',
                    ],
                ],
                'label'=>'permissions',
                'management'=>'Permission Management',
                'no_roles'=>'No Roles',
                'no_permissions'=>'No Permissions',
                'tabs'=>[
                    'dependencies'=>'Dependencies',
                    'general'=>'General',
                    'groups'=>'All Groups',
                    'permissions'=>'All Permissions',
                ],
                'table'=>[
                    'dependencies' => 'Dependencies',
                    'group' => 'Group',
                    'group-sort' => 'Group Sort',
                    'name' => 'Name',
                    'permission' => 'Permission',
                    'roles' => 'Roles',
                    'system' => 'System',
                    'total' => 'permission total|permissions total',
                    'users' => 'Users',
                ],
                'ungrouped_permissions'=>'Ungrouped Permissions',
                'no_ungrouped'=>'There are no ungrouped permissions.',
            ],
            'users'=>[
                'active'=>'Active Users',
                'all_permissions'=>'All Permissions',
                'create'=>'Create User',
                'change_password'=>'Change Password',
                'change_password_for'=>'Change Password For :user',
                'deleted'=>'Deleted Users',
                'deactivated'=>'Deactivated Users',
                'edit'=>'Edit User',
                'dependencies'=>'Dependencies',
                'management'=>'User Management',
                'no_roles'=>'No Roles',
                'no_other_permissions'=>'No Other Permissions',
                'no_permissions'=>'No Permissions',
                'no_deactivated'=>'No Deactivated Users',
                'table'=>[
                    'id'=>'ID',
                    'name'=>'Name',
                    'e-mail'=>'E-mail',
                    'confirmed'=>'Confirmed',
                    'roles'=>'Roles',
                    'no_deleted'=>'No Deleted Users',
                    'other-permissions'=>'Other Permissions',
                    'created'=>'Created',
                    'last_updated'=>'Last Updated',
                    'total'=>'user total|users total',
                ],
                'permission_check'=>'Checking a permission will also check its dependencies, if any.',
                'permissions'=>'permissions',
            ],
        ],
    ],
    'frontend'=>[
        'auth'=>[
            'login_box_title'=>'Login',
            'login_button'=>'Login',
            'register_button'=>'register',
            'remember_me'=>'Remember Me',
        ],
        'macros'=>[
            'country'=>[
                'alpha' => 'Country Alpha Codes',
                'alpha2' => 'Country Alpha 2 Codes',
                'alpha3' => 'Country Alpha 3 Codes',
                'numeric' => 'Country Numeric Codes',
            ],
            'macro_examples'=>'Macros Examples',
            'state'=>[

                'mexico'=>'Mexico State List',
                'us'=>[
                    'armed'=>'US Armed Forces',
                    'us'=>'US States',
                    'outlying'=>'US Outlying Territories',
                ],
            ],
            'timezone'=>'Timezone',
            'territories'=>[
                'canada'=>'Canada Province & Territories List',
            ],
        ],
        'passwords'=>[
            'forgot_password'=>'Forgot Your Password?',
        ],
        'user'=>[
            'profile'=>[
                'avatar'=>'Avatar',
                'edit_information'=>'Edit Information',
                'name'=>'Name',
                'email'=>'E-mail',
                'created_at'=>'Created At',
                'last_updated'=>'Last Updated',
                'update_information'=>'Update Information',
            ],
            'passwords'=>[
                'change'=>'Change Password',
            ],
        ],
    ],
    'general'=>[
        'all'=>'All',
        'actions'=>'Actions',
        'buttons'=>[
            'save'=>'Save',
            'update'=>'Update',
        ],
        'custom'=>'Custom',
        'hide'=>'Hide',
        'no'=>'No',
        'none'=>'None',
        'yes'=>'Yes',
        'toggle_navigation' => 'Toggle Navigation',
        'show'=>'Show',
    ],
];