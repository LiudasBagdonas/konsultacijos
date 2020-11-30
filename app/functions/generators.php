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
                'chart' => [
                    'value' => 'My Order',
                    'path' => '/chart.php'
                ],
                'logout' => [
                    'value' => 'Log Out',
                    'path' => '/logout.php',
                    'user' => $_SESSION['name']
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

function count_my_items()
{
    $db_data = file_to_array(DB_FILE);
    $my_items = [];

    if (isset($db_data['items'])) {
        foreach ($db_data['items'] as $item) {
            if (isset($item['user']) && $item['user'] === $_SESSION['email']) {
                $my_items[] = $item;
            }
        }
    }
    return $my_items;
}

function not_my_items()
{
    $db_data = file_to_array(DB_FILE);
    $result = [];

    if (isset($db_data['items'])) {
        foreach ($db_data['items'] as $item) {
            if (isset($item['user']) && $item['user'] !== $_SESSION['email']) {
                $result[] = $item;
            }
        }
    }
    return $result;
}

function total_price()
{
    $db_data = file_to_array(DB_FILE);
    $result = 0;

    if (isset($db_data['selected'])) {
        foreach ($db_data['selected'] as $item) {
            $result += $item['price'];
        }
    }
    return $result;
}

function selected_items()
{
    $db_data = file_to_array(DB_FILE);
    $result = [];

    if (isset($db_data['credentials'])) {
        foreach ($db_data['credentials'] as $user_index => $user) {
            if (isset($user['user_selected']) && $user['email'] === $_SESSION['email']) {
                foreach ($user['user_selected'] as $selected_item) {
                    $result[] = $selected_item;
                }
            }
        }
    }
    return $result;
}

