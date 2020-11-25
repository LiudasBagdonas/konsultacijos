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
                'myStuff' => [
                    'value' => 'My Stuff',
                    'path' => '/admin/myStuff.php'
                ],
                'logout' => [
                    'value' => 'Log Out',
                    'path' => '/logout.php',
                    'user' => $_SESSION['user']
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

function count_my_items() {
    $db_data = file_to_array(DB_FILE);
    $count = 0;

    foreach($db_data['items'] as $item) {
        if(isset($item['id']) && $item['id'] === $_SESSION['email']) {
            $count ++;
        }
    }
    return $count;
}