<?php
return [
    \common\models\UserProject::PROJECT_BACKEND => [
        ['name' => '/user/index', 'description' => '用户列表'],
        ['name' => '/user/create-modal', 'description' => '创建用户弹框'],
        ['name' => '/user/update-modal', 'description' => '修改用户弹框'],
        ['name' => '/user/save-user', 'description' => '保存用户'],
        ['name' => '/user/delete-user', 'description' => '删除用户'],
        ['name' => '/page/index', 'description' => 'page列表'],
    ],
    \common\models\UserProject::PROJECT_FRONTEND => [],
];