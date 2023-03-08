<?php

return [
    'permissions' => [
        [
            'title' => '首页(site)全选/取消',
            'data' => [
                ['name' => 'backend/site/index', 'description' => '首页'],
            ]
        ],

        [
            'title' => '用户(User)全选/取消',
            'data' => [
                ['name' => 'backend/user/index', 'description' => '用户列表'],
                ['name' => 'backend/user/create-modal', 'description' => '创建用户弹框'],
                ['name' => 'backend/user/update-modal', 'description' => '编辑用户弹框'],
                ['name' => 'backend/user/save-user', 'description' => '保存用户'],
                ['name' => 'backend/user/delete-user', 'description' => '删除用户'],
            ]
        ],

        [
            'title' => '角色(Role)全选/取消',
            'data' => [
                ['name' => 'backend/role/index', 'description' => '角色列表'],
                ['name' => 'backend/role/create-modal', 'description' => '创建角色弹框'],
                ['name' => 'backend/role/update-modal', 'description' => '编辑角色弹框'],
                ['name' => 'backend/role/save', 'description' => '保存角色'],
                ['name' => 'backend/role/delete', 'description' => '删除角色'],
            ]
        ],

        [
            'title' => '权限(Permission)全选/取消',
            'data' => [
                ['name' => 'backend/permission/index', 'description' => '权限列表'],
                ['name' => 'backend/permission/save', 'description' => '保存权限'],
            ]
        ],

        [
            'title' => '页面(Page)全选/取消',
            'data' => [
                ['name' => 'backend/page/index', 'description' => '页面列表'],
                ['name' => 'backend/page/create-modal', 'description' => '创建页面弹框'],
                ['name' => 'backend/page/update-modal', 'description' => '编辑页面弹框'],
                ['name' => 'backend/page/save-page', 'description' => '保存页面'],
                ['name' => 'backend/page/delete-page', 'description' => '删除页面'],
                ['name' => 'backend/page-content/index', 'description' => '页面内容'],
                ['name' => 'backend/page-content/upload', 'description' => '页面内容上传'],
                ['name' => 'backend/page-content/save', 'description' => '页面内容保存'],
            ]
        ],

        [
            'title' => '围棋(Wq)全选/取消',
            'data' => [
                ['name' => 'backend/wq/rank', 'description' => '围棋排列'],
                ['name' => 'backend/wq-blacklist/index', 'description' => '围棋黑名单列表'],
                ['name' => 'backend/wq-blacklist/create-modal', 'description' => '创建围棋黑名单弹框'],
                ['name' => 'backend/wq-blacklist/update-modal', 'description' => '编辑围棋黑名单弹框'],
                ['name' => 'backend/wq-blacklist/create', 'description' => '创建围棋黑名单'],
                ['name' => 'backend/wq-blacklist/update', 'description' => '编辑围棋黑名单'],
                ['name' => 'backend/wq-blacklist/delete', 'description' => '删除围棋黑名单'],
            ]
        ],

        [
            'title' => '树形图(Taxonomy)全选/取消',
            'data' => [
                ['name' => 'backend/taxonomy/index', 'description' => '树状图页'],
                ['name' => 'backend/taxonomy/get-tree-data', 'description' => '树状图数据'],
                ['name' => 'backend/taxonomy/create', 'description' => '创建树状图节点'],
                ['name' => 'backend/taxonomy/update', 'description' => '编辑树状图节点'],
                ['name' => 'backend/taxonomy/delete', 'description' => '删除树状图节点'],
                ['name' => 'backend/taxonomy/drag', 'description' => '拖动树状图节点'],
                ['name' => 'backend/taxonomy/init-top', 'description' => '树状图初始化最高节点'],
            ]
        ],
    ]
];












