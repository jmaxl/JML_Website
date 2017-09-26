<?php
return [
    'project' => [
        'name' => 'JML Website',
        'namespace' => 'JML'
    ],
    'template' => [
        'name' => 'default',
        'dir' =>  '/default',
        'cacheDir' => '/cache'
    ],
    'database' => [
        'host' => 'localhost',
        'user' => 'root',
        'password' => '',
        'database' => 'database_jml'
    ],
    'controller' => [
        'namespace' => 'Controller'
    ],
    'route' => [
        'index' => [
            'controller' => 'IndexController',
            'action' => 'indexAction'
        ],
        'impressum' => [
            'controller' => 'IndexController',
            'action' => 'impressumAction',
        ]
    ]
];