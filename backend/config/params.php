<?php
return [
    'project' => 'backend',
    'action_auth' => [
        'user_without_auth' => ['site/logout'], //登录用户不需要验证
        'guest_only' => ['site/login', 'site/loginAjax'], //游客才能访问
        'all_without_auth' => [], //所有用户不需要验证
    ],
    'menu' => [
        [
            ['name' => '用户', 'path' => 'user/index', 'url' => '/user/index'],
            ['name' => '用户列表', 'path' => 'user/index', 'url' => '/user/index'],
        ],
        [
            ['name' => '页面', 'path' => 'page/index', 'url' => '/page/index'],
            ['name' => '页面列表', 'path' => 'page/index', 'url' => '/page/index'],
        ],
        [
            ['name' => '安全', 'path' => 'role/index', 'url' => '/role/index'],
            ['name' => '角色列表', 'path' => 'role/index', 'url' => '/role/index'],
            ['name' => '权限列表', 'path' => 'permission/index', 'url' => '/permission/index'],
        ],
    ],
    'log_data_table' => [
        '{{user}}' => ['module' => 'user', 'table' => 'user', 'desc' => '用户'],
    ],
];
