<?php
return [
    'frontend'=>[
        'email'=>[
            'confirm_account'=>'Click here to confirm your account:',
        ],
        'test'=>'Test',
        'tests'=>[
            'based_on'=>[
                'permission'=>'Permission Based -',
                'role'=>'Role Based -',
                'you_can_see_because'=>'You can see this because you have the role of \':role\'!',
                'you_can_see_because_permission'=>'You can see this because you have the permission of \':permission\'!',
            ],
            'js_injected_from_controller'=>' Javascript Injected from a Controller',
            'using_access_helper'=>[
                'array_roles_not'=>'Using Access Helper with Array of Role Names or ID\'s where the user does not  have to posses all.',
                'permission_id'=>'Using Access Helper with Permission ID',
                'permission_name'=>'Using Access Helper with Permission Name',
                'role_id'=>'Using Access Helper with Role ID',
                'role_name'=>'Using Access Helper with Role Name',
            ],
            'using_blade_extensions'=>'Using Blade Extensions',
            'view_console_it_works'=>'View console, you should see \'it works!\' which is coming from FrontendController@index',
        ],
        'welcome_to'=>'Welcome to :place',
        'user'=>[
            'password_updated'=>'Password Successfully updated',
            'profile_updated'=>'Profile Successfully updated',
        ],
    ],

    'backend'=>[
        'access'=>[
            'users'=>[
                'if_confirmed_off'=>'If confirmed is off',
                'delete_user_confirm'=>'Are you sure you want to delete this user permanently? Anywhere in the application that references this user\'s id will most likely error . Proceed at your own risk . This can not be un - done .',
            ],
            'permissions'=>[
                'edit_explanation'=>'If you performed operations in the hierarchy section without refreshing this page, you will need to refresh to reflect the changes here.',
                'sort_explanation'=>'This section allows you to organize your permissions into groups to stay organized. Regardless of the group, the permissions are still individually assigned to each role.',
            ],
        ],
        'dashboard'=>[
            'title' => 'Administrative Dashboard',
            'welcome' => 'Welcome',
        ],
        'general'=>[
            'all_rights_reserved'=>'All Rights Reserved.',
            'continue' => 'Continue',
            'are_you_sure'=>'Are you sure?',
            'boilerplate_link'=>'Laravel 5 Boilerplate',
            'member_since'=>'Member since',
            'status'=>[
                'online'=>'Online',
                'offline'=>'Offline',
            ],
            'see_all'=>[
                'messages'=>'See all messages',
                'notifications'=>'See all notifications',
                'tasks'=>'See all tasks',
            ],
            'search_placeholder'=>'Search...',
            'you_have'=>[
                'messages'=>'{0} You don\'t have messages|{1} You have 1 message|[2,Inf] You have :number messages',
                'notifications'=>'{0} You don\'t have notifications|{1} You have one notification |[2, Inf]You have :number notifications',
                'tasks'=>'{0} You don\'t have task |{1} You have 1 tasks|[2,Inf] You have :number tasks',
            ],
        ],
    ],
];