<?php

require '../bootloader.php';

$nav = nav();

if (is_logged_in()) {
    header('Location: /index.php');
}

$form = [
    'attr' => [
        'method' => 'POST',
    ],
    'fields' => [
        'name' => [
            'label' => 'Name',
            'type' => 'text',
            'validators' => [
                'validate_has_no_number'
            ],
            'extra' => [
                'attr' => [
                    'placeholder' => 'Your name...',
                    'class' => 'input-field',
                ]
            ]
        ],
        'surname' => [
            'label' => 'Surname',
            'type' => 'text',
            'validators' => [
                'validate_has_no_number'
            ],
            'extra' => [
                'attr' => [
                    'placeholder' => 'Your surname...',
                    'class' => 'input-field',
                ]
            ]
        ],
        'email' => [
            'label' => 'Email',
            'type' => 'text',
            'validators' => [
                'validate_field_not_empty',
                'validate_email',
                'validate_user_unique',
            ],
            'extra' => [
                'attr' => [
                    'placeholder' => 'Your email...',
                    'class' => 'input-field',
                ]
            ]
        ],
        'address' => [
            'label' => 'Address',
            'type' => 'text',
            'validators' => [
                'validate_field_not_empty'
            ],
            'extra' => [
                'attr' => [
                    'placeholder' => 'Your address...',
                    'class' => 'input-field',
                ]
            ]
        ],
        'number' => [
            'label' => 'Phone number',
            'type' => 'text',
            'validators' => [
                'validate_field_not_empty',
                'validate_number'
            ],
            'extra' => [
                'attr' => [
                    'placeholder' => 'Phone number...',
                    'class' => 'input-field',
                ]
            ]
        ],
        'password' => [
            'label' => 'Password',
            'type' => 'password',
            'validators' => [
                'validate_field_not_empty',
                'validate_max_4_chars',
                'validate_has_number'
            ],
            'extra' => [
                'attr' => [
                    'placeholder' => 'Įvesk slaptažodį',
                    'class' => 'input-field',
                ]
            ]
        ],
        'password_repeat' => [
            'label' => 'Password repeat',
            'type' => 'password',
            'validators' => [
                'validate_field_not_empty',
                'validate_max_4_chars',
                'validate_has_number'
            ],
            'extra' => [
                'attr' => [
                    'placeholder' => 'Įvesk slaptažodį dar kartą',
                    'class' => 'input-field',
                ]
            ]
        ],
    ],
    'buttons' => [
        'send' => [
            'title' => 'Registruokis',
            'type' => 'submit',
            'extra' => [
                'attr' => [
                    'class' => 'btn',
                ]
            ]
        ]
    ],
    'validators' => [
        'validate_fields_match' => [
            'password',
            'password_repeat'
        ]
    ]
];

$clean_inputs = get_clean_input($form);

if ($clean_inputs) {
    $is_valid = validate_form($form, $clean_inputs);

    if ($is_valid) {
        unset($clean_inputs['password_repeat']);
        $buy_history = ['buy_history' => [], 'user_selected' => []];

        // Get data from file
        $input_from_json = file_to_array(DB_FILE);
        // Append new data from form
        $input_from_json['credentials'][] = $clean_inputs + $buy_history;
        // Save old data together with appended data back to file
        array_to_file($input_from_json, DB_FILE);

        header('Location: /login.php');

    }
}

?>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
    <link rel="stylesheet" href="media/styles.css">
</head>
<body>
<header>
    <?php require ROOT . './app/templates/nav.php'; ?>
</header>
<main>
    <h2>Registruokis</h2>
    <?php require ROOT . '/core/templates/form.tpl.php'; ?>
</main>
</body>
</html>

