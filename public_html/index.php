<?php

require '../bootloader.php';

$db_data = file_to_array(DB_FILE);

$h1 = 'Welcome to Pet Shop';
$nav = nav();
?>
<html>
<head>
    <meta charset="UTF-8">
    <title>Home</title>
    <link rel="stylesheet" href="media/styles.css">
</head>
<body>
<header>
    <?php require ROOT . './app/templates/nav.php';?>
</header>
<main>
    <h1><?php print $h1; ?></h1>
    <!-- Place for products grid -->
    <article class="items_box">
        <?php if (isset($db_data['items'])): ?>
        <?php foreach ($db_data['items'] as $item): ?>
            <section class="item_box">
                <span class="item_title"><?php print $item['name'] ;?></span>
                <div class="item_image" style="background-image: url('<?php print $item['image']; ?>')"></div>
                <p class="item_price"><?php print $item['price']; ?> Eur.</p>
                <p class="item_description"><?php print $item['description']; ?></p>
            </section>
        <?php endforeach; ?>
        <?php endif; ?>
    </article>
</main>
</body>
</html>

