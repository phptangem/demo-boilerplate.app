<?php
return [
    'frontend'=>[
        'auth'=>[
            'confirmation'=>[
                'already_confirmed'=>'Your account has already confirmed',
                'mismatch'=>'Your confirmation code does not match.',
                'not_found'=>'The confirmation code does not found.',
            ],
            'email_token'=>'The e-mail address has already been taken',
            'password'=>[
                'change_mismatch'=>'This is not your old password',
            ],
        ],
    ],
    'backend'=>[
        'access'=>[
            'permissions'=>[
                'created_error'=>'There was a problem creating this permission.Please try again.',

                'groups'=>[
                    'associated_permissions' => 'You can not delete this group because it has associated_permissions.',
                    'has_children' => 'You can not delete this group, because it has children group.',
                    'name_taken' => 'There is already a group with that name',
                ],

                'not_found'=>'That permission does not exist.',
                'system_delete_error'=>'You can not delete a system permission.',
                'update_error'=>'There was a problem updating this permission.Please try again.'
            ],
            'roles'=>[
                'already_exists'=>'The role already exists.Please choose a different name.',
                'create_error'=>'There was a role creating this role. Please try again.',
                'cant_delete_admin'=>'You can not delete the Administrator role',
                'has_users'=>'You can not delete a role with associated users',
                'not_found'=>'The role does not exist.',
                'needs_permission'=>'You must select at least one permission for this role.',
                'update_error'=>'There was a problem updating this role. Please try again.',
            ],
            'users'=> [
                'create_error'=>'There was a problem creating this user. Please try again.',
                'delete_error'=>'There was a problem deleting this user.Please try again.',
                'email_error'=>'That email address belongs to a different user.',
                'cant_delete_self'=>'You can not delete yourself',
                'mark_error'=>'There was a problem updating user,Please try again.',
                'role_needed'=>'You must choose at least one role',
                'role_needed_created' =>'You must choose at least one role. User has been created but deactivate',
                'restore_error'=>'There was a problem restoring this user.Please try again.',
                'update_error'=>'There was a problem updating this user.Please try again.',
                'update_password_error'=>'There was a problem changing this users password.Please try again.',
            ],
        ],
    ],
];