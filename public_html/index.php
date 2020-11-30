<?php

require '../bootloader.php';

$db_data = file_to_array(DB_FILE);
if (!is_logged_in()) {
    if (isset($db_data['items'])) {
        $items = $db_data['items'];
    } else {
        $items = [];
    }
} else {
    $items = not_my_items();
}

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
    <?php require ROOT . './app/templates/nav.php'; ?>
</header>
<main>
    <h1><?php print $h1; ?></h1>

    <?php if (isset($db_data['items'])): ?>

        <h3>Items list: <?php print count($items); ?></h3>
        <article class="items_box">

            <?php foreach ($items as $item): ?>

                <section class="item_box">
                    <span class="item_title"><?php print $item['name']; ?></span>
                    <div class="item_image" style="background-image: url('<?php print $item['image']; ?>')"></div>
                    <p class="item_price"><?php print $item['price']; ?> Eur.</p>
                    <p class="item_description"><?php print $item['description']; ?></p>
                    <?php if (!$item['selected']): ?>
                        <form action="chart.php" method="POST">
                            <button type="submit" name="product_id" value="<?php print $item['id']; ?>">Adopt me!
                            </button>
                        </form>
                    <?php endif; ?>
                </section>
            <?php endforeach; ?>

        </article>
    <?php else: ?>
        <span>List is empty.</span>
    <?php endif; ?>
</main>
</body>
</html>

