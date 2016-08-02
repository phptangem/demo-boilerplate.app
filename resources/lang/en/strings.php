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
        'general'=>[
            'member_since'=>'Member since',
            'see_all'=>[
                'messages'=>'See all messages',
                'notifications'=>'See all notifications',
                'tasks'=>'See all tasks',
            ],
            'you_have'=>[
                'messages'=>'{0} You don\'t have messages|{1} You have 1 message|[2,Inf] You have :number messages',
                'notifications'=>'{0} You don\'t have notifications|{1} You have one notification |[2, Inf]You have :number notifications',
                'tasks'=>'{0} You don\'t have task |{1} You have 1 tasks|[2,Inf] You have :number tasks',
            ],
        ],
    ],
];