<?php
return [
    'project' => [
        'name' => 'JML Website',
        'namespace' => 'JML'
    ],
    'template' => [
        'name' => 'default',
        'dir' => '/default',
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
        'logIn' => [
            'controller' => 'IndexController',
            'action' => 'logInAction'
        ],
        'logInRedirect' => [
            'controller' => 'IndexController',
            'action' => 'logInRedirectAction'
        ],
        'impressum' => [
            'controller' => 'IndexController',
            'action' => 'impressumAction',
        ],
        'backend' => [
            'controller' => 'BackendController',
            'action' =>'backendAction',
        ],
        'createArticle' => [
            'controller' => 'BackendController',
            'action' => 'createArticleAction',
        ],
        'deleteArticle' => [
            'controller' => 'BackendController',
            'action' => 'deleteArticleAction',
        ],
        'editArticle' => [
            'controller' => 'JsonController',
            'action' => 'editArticleAction',
        ],
        'submitEditArticle' => [
            'controller' => 'BackendController',
            'action' => 'createEditArticleAction',
        ]
    ]
];