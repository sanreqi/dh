<?php
return [
    'project' => 'backend',
    'action_auth' => [
        'user_without_auth' => ['backend/site/logout'], //登录用户不需要验证
        'guest_only' => ['backend/site/login', 'backend/site/loginAjax'], //游客才能访问
        'all_without_auth' => [], //所有用户不需要验证
    ],
    'menu' => [
        [
            ['name' => '用户', 'path' => 'backend/user/index', 'url' => '/user/index'],
            ['name' => '用户列表', 'path' => 'backend/user/index', 'url' => '/user/index'],
        ],
        [
            ['name' => '页面', 'path' => 'backend/page/index', 'url' => '/page/index'],
            ['name' => '页面列表', 'path' => 'backend/page/index', 'url' => '/page/index'],
        ],
        [
            ['name' => '安全', 'path' => 'backend/role/index', 'url' => '/role/index'],
            ['name' => '角色列表', 'path' => 'backend/role/index', 'url' => '/role/index'],
//            ['name' => '权限列表', 'path' => 'permission/index', 'url' => '/permission/index'],
        ],
        [
            ['name' => '围棋', 'path' => 'backend/wq-blacklist/index', 'url' => '/wq-blacklist/index'],
            ['name' => '开狗黑名单', 'path' => 'backend/wq-blacklist/index', 'url' => '/wq-blacklist/index'],
            ['name' => '围棋排列计算', 'path' => 'backend/wq/rank', 'url' => '/wq/rank'],
        ],
        [
            ['name' => 'ASD', 'path' => 'backend/asd-diary/index', 'url' => '/asd-diary/index'],
            ['name' => 'DIARY', 'path' => 'backend/asd-diary/index', 'url' => '/asd-diary/index'],
        ],
        [
            ['name' => '分类', 'path' => 'backend/taxonomy/index', 'url' => '/taxonomy/index'],
            ['name' => '树形图', 'path' => 'backend/taxonomy/index', 'url' => '/taxonomy/index'],
        ],
    ],
    'log_data_table' => [
        '{{user}}' => ['module' => 'user', 'table' => 'user', 'desc' => '用户'],
    ],
];
