<?php
return [
    'adminEmail' => 'admin@example.com',
    'sidebar_menu' => [
        [
            'label' => 'Dashboard',
            'icon' => 'dashboard',
            'icon-class' => 'media-left media-middle material-icons',
            'url' => '/admin',
            'linkOptions' => [
                'class' => 'pmd-ripple-effect',
            ],

        ],
        [
            'label' => 'User',
            'icon' => 'extension',
            'badge' => '4',
            'url' => 'javascript:void(0)',
            'icon-class' => 'media-left media-middle material-icons',
            'linkOptions' => [
                'aria-expanded' => 'false',
                'class' => 'btn-user dropdown-toggle media',
                'data-toggle' => "dropdown",
                'data-sidebar' => "true",
            ],
            'items' => [
                [
                    'label' => 'All User',
                    'url' => '/admin/user/user',
                    'linkOptions' => [
                        'aria-expanded' => 'false',
                        'class' => 'btn-user dropdown-toggle media',
                        'data-toggle' => "dropdown",
                        'data-sidebar' => "true",
                    ],
                ],
                [
                    'label' => 'Permission',
                    'url' => '/admin/user/permission',
                    'linkOptions' => [
                        'aria-expanded' => 'false',
                        'class' => 'btn-user dropdown-toggle media',
                        'data-toggle' => "dropdown",
                        'data-sidebar' => "true",
                    ],
                ],
                [
                    'label' => 'Route',
                    'url' => '/admin/user/route',
                    'linkOptions' => [
                        'aria-expanded' => 'false',
                        'class' => 'btn-user dropdown-toggle media',
                        'data-toggle' => "dropdown",
                        'data-sidebar' => "true",
                    ],
                ],
                [
                    'label' => 'Rules',
                    'url' => '/admin/user/rule',
                    'linkOptions' => [
                        'aria-expanded' => 'false',
                        'class' => 'btn-user dropdown-toggle media',
                        'data-toggle' => "dropdown",
                        'data-sidebar' => "true",
                    ],
                ],
                [
                    'label' => 'Assignments',
                    'url' => '/admin/user/assignment',
                    'linkOptions' => [
                        'aria-expanded' => 'false',
                        'class' => 'btn-user dropdown-toggle media',
                        'data-toggle' => "dropdown",
                        'data-sidebar' => "true",
                    ],
                ],
                [
                    'label' => 'Role',
                    'url' => '/admin/user/role
                        ',
                    'linkOptions' => [
                        'aria-expanded' => 'false',
                        'class' => 'btn-user dropdown-toggle media',
                        'data-toggle' => "dropdown",
                        'data-sidebar' => "true",
                    ],
                ],
            ],
        ],
        [
            'label' => 'Page',
            'icon' => 'content_copy',
            'icon-class' => 'media-left media-middle material-icons',
            'url' => '/admin/page',
            'linkOptions' => [
                'class' => 'pmd-ripple-effect',
            ],

        ],
        [
            'label' => 'Menu',
            'icon' => 'menu',
            'icon-class' => 'media-left media-middle material-icons',
            'url' => '/admin/user/menu',
            'linkOptions' => [
                'class' => 'pmd-ripple-effect',
            ],

        ],
        [
            'label' => 'Settings',
            'icon' => 'settings',
            'icon-class' => 'media-left media-middle material-icons',
            'url' => '/admin/settings',
            'linkOptions' => [
                'class' => 'pmd-ripple-effect',
            ],

        ],
    ],
];
