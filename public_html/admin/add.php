<?php
require '../../bootloader.php';

if (!is_logged_in()) {
    header('Location: /login.php');
}

$form = [
    'attr' => [
        'method' => 'POST',
    ],
    'fields' => [
        'name' => [
            'label' => 'Item Name',
            'type' => 'text',
            'validators' => [
                'validate_field_not_empty',
            ],
            'extra' => [
                'attr' => [
                    'placeholder' => 'Enter Item Name',
                    'class' => 'input-field',
                ]
            ]
        ],
        'price' => [
            'label' => 'Price',
            'type' => 'number',
            'validators' => [
                'validate_field_not_empty',
                'validate_number'
            ],
            'extra' => [
                'attr' => [
                    'placeholder' => '30 £...',
                    'class' => 'input-field',
                ]
            ]
        ],
        'image' => [
            'label' => 'Image of Item',
            'type' => 'text',
            'validators' => [
                'validate_field_not_empty',
            ],
            'extra' => [
                'attr' => [
                    'placeholder' => 'Enter url of image',
                    'class' => 'input-field',
                ]
            ]
        ],
        'description' => [
            'label' => 'Description',
            'type' => 'textarea',
            'validators' => [
                'validate_field_not_empty',
            ],
            'extra' => [
                'attr' => [
                    'placeholder' => 'Something something...',
                    'class' => 'input-field',
                ]
            ]
        ],
    ],
    'buttons' => [
        'send' => [
            'title' => 'Upload',
            'type' => 'submit',
            'extra' => [
                'attr' => [
                    'class' => 'btn',
                ]
            ]
        ]
    ],
    'validators' => [

    ]
];


$clean_inputs = get_clean_input($form);

if ($clean_inputs) {

    $is_valid = validate_form($form, $clean_inputs);

    if ($is_valid) {

        // Get data from file
        $input_from_json = file_to_array(ROOT . '/app/data/db.json');
        // Append new data from form
        $input_from_json['items'][] = $clean_inputs;
        // Save old data together with appended data back to file
        array_to_file($input_from_json, ROOT . '/app/data/db.json');

//        header('Location: /index.php');

    }

}
$nav = nav();

?>
<html>
<head>
    <title>Add Item</title>
    <link rel="stylesheet" href="../media/styles.css">
</head>
<body>
<header>
    <?php require ROOT . './app/templates/nav.php';?>
</header>
<main>
    <?php require ROOT . './core/templates/form.tpl.php';?>
</main>
</body>
</html>
