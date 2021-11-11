<?php
use \common\models\UserProject;

return [
    'adminEmail' => 'admin@example.com',
    'supportEmail' => 'support@example.com',
    'senderEmail' => 'noreply@example.com',
    'senderName' => 'Example.com mailer',
    'user.passwordResetTokenExpire' => 3600,

    'permissions' => [
        UserProject::PROJECT_BACKEND => [
            UserProject::CONTROLLER_BACKEND_USER => [
                ['name' => '/user/index', 'description' => '用户列表'],
                ['name' => '/user/create-modal', 'description' => '创建用户弹框'],
                ['name' => '/user/update-modal', 'description' => '修改用户弹框'],
                ['name' => '/user/save-user', 'description' => '保存用户'],
                ['name' => '/user/delete-user', 'description' => '删除用户'],
            ],
            UserProject::CONTROLLER_BACKEND_ROLE => [
                ['name' => '/role/index', 'description' => '角色列表'],
                ['name' => '/role/create-modal', 'description' => '创建角色弹框'],
                ['name' => '/role/update-modal', 'description' => '修改角色弹框'],
                ['name' => '/role/save', 'description' => '保存角色'],
                ['name' => '/role/delete', 'description' => '删除角色'],
            ],
        ],
        UserProject::PROJECT_FRONTEND => [
//            UserProject::CONTROLLER_BACKEND_PAGE => [
//                ['name' => '/page/index', 'description' => 'page列表'],
//            ],
        ],
    ]
];
