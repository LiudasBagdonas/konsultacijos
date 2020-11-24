<?php

function nav()
{
    if (is_logged_in()) {
        $nav = [
            'links' => [
                'home' => [
                    'value' => 'Home',
                    'path' => '/index.php'
                ],
                'add' => [
                    'value' => 'Add Item',
                    'path' => '/admin/add.php'
                ],
                'logout' => [
                    'value' => 'Log Out',
                    'path' => '/logout.php'
                ],
            ],
        ];

        return $nav;
    } else {
        $nav = [
            'links' => [
                'home' => [
                    'value' => 'Home',
                    'path' => '/index.php'
                ],
                'register' => [
                    'value' => 'Register',
                    'path' => '/register.php'
                ],
                'login' => [
                    'value' => 'Log In',
                    'path' => '/login.php'
                ],
            ],
        ];

        return $nav;
    }
}