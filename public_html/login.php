<?php

require '../bootloader.php';
$nav = nav();

if (is_logged_in()) {
    header('Location: /admin/add.php');
}

$form = [
    'attr' => [
        'method' => 'POST',
    ],
    'fields' => [
        'email' => [
            'label' => 'Email',
            'type' => 'text',
            'validators' => [
                'validate_field_not_empty',
                'validate_email',
            ],
            'extra' => [
                'attr' => [
                    'placeholder' => 'Įvesk emailą',
                    'class' => 'input-field',
                ],
            ],
        ],
        'password' => [
            'label' => 'Password',
            'type' => 'password',
            'validators' => [
                'validate_field_not_empty',
            ],
            'extra' => [
                'attr' => [
                    'placeholder' => 'Įvesk slaptažodį',
                    'class' => 'input-field',
                ],
            ],
        ],
    ],
    'buttons' => [
        'send' => [
            'title' => 'Login',
            'type' => 'submit',
            'extra' => [
                'attr' => [
                    'class' => 'btn',
                ],
            ],
        ],
    ],
    'validators' => [
        'validate_login' => [
            'email',
            'password',
        ]
    ]
];

$clean_inputs = get_clean_input($form);

if ($clean_inputs) {
    $form_success = validate_form($form, $clean_inputs);

    if ($form_success) {
        $_SESSION['email'] = $clean_inputs['email'];
        $_SESSION['password'] = $clean_inputs['password'];

        $input_from_json = file_to_array(DB_FILE);

        foreach ($input_from_json['credentials'] as $user) {
            if ($_SESSION['email'] === $user['email']) {
                $_SESSION['name'] = $user['name'];
                $_SESSION['surname'] = $user['surname'];
            }
        }

        header('Location: /index.php');
    }
}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link rel="stylesheet" href="media/styles.css">
</head>
<body>
<header>
    <?php require ROOT . './app/templates/nav.php';?>
</header>
<main>
    <?php require ROOT . '/core/templates/form.tpl.php'; ?>
</main>
</body>
</html>