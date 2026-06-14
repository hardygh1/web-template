<?php

return [
    [
        'type' => 'link',
        'title' => 'Dashboard',
        'icon' => 'fa-solid fa-chart-pie',
        'route' => 'admin.dashboard',
        'active' => 'admin.dashboard',
        'can' => ['access_dashboard'],
    ],
    [
        'type' => 'header',
        'title' => 'Autenticación & Permisos',
        'can' => [
            'read_role',
            'read_user',
        ]
    ],
    [
        'type' => 'link',
        'title' => 'Roles y Permisos',
        'icon' => 'fa-solid fa-shield-halved',
        'route' => 'admin.roles.index',
        'active' => 'admin.roles.*',
        'can' => [
            'read_role',
        ]
    ],
    [
        'type' => 'link',
        'title' => 'Usuarios',
        'icon' => 'fa-solid fa-users',
        'route' => 'admin.users.index',
        'active' => 'admin.users.*',
        'can' => [
            'read_user'
        ]
    ],
];
