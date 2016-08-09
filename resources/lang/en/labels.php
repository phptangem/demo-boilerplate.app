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
                'table'=>[
                    'role'=>'Role',
                    'permissions'=>'Permissions',
                    'number_of_users'=>'Number of Users',
                    'sort'=>'Sort',
                ],
            ],
            'users'=>[
                'active'=>'Active Users',
                'all_permissions'=>'All Permissions',
                'create'=>'Create User',
                'deleted'=>'Deleted Users',
                'deactivated'=>'Deactivated Users',
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