<?php

require '../../bootloader.php';
$db_data = file_to_array(DB_FILE);

if (isset($_POST['checkout'])){
    if($_POST['checkout'] === 'true') {
        foreach ($db_data['credentials'] as $user_index => &$user) {
            if ($user['email'] === $_SESSION['email']) {
                foreach ($db_data['credentials'][$user_index]['user_selected'] as $selected_item) {
                    $db_data['credentials'][$user_index]['buy_history'][] = $selected_item;
                }
                $db_data['credentials'][$user_index]['user_selected'] = [];
            }
            foreach ($user['buy_history'] as $bought_item) {
                foreach ($db_data['items'] as $item_index => &$item) {
                    if ($bought_item['id'] === $item['id']) {
                        unset($db_data['items'][$item_index]);
                    }
                }
            }
        }
    }
}


array_to_file($db_data, DB_FILE);
$db_data = file_to_array(DB_FILE);

$h1 = 'My items';
$my_items_array = count_my_items();

$nav = nav();
?>
<html>
<head>
    <meta charset="UTF-8">
    <title>Home</title>
    <link rel="stylesheet" href="../media/styles.css">
</head>
<body>
<header>
    <?php require ROOT . './app/templates/nav.php'; ?>
</header>
<main>
    <h1><?php print $h1; ?></h1>
    <?php if (isset($db_data['items'])): ?>

        <h3>My items: <?php print count($my_items_array); ?></h3>
        <article class="items_box">

            <?php foreach ($my_items_array as $item): ?>

                <?php if (isset($item['user']) && $item['user'] === $_SESSION['email']): ?>
                    <section class="item_box">
                        <span class="item_title"><?php print $item['name']; ?></span>
                        <div class="item_image" style="background-image: url('<?php print $item['image']; ?>')"></div>
                        <p class="item_price"><?php print $item['price']; ?> Eur.</p>
                        <p class="item_description"><?php print $item['description']; ?></p>
                    </section>
                <?php endif; ?>

            <?php endforeach; ?>

        </article>
    <?php else: ?>
        <span>List is empty.</span>
    <?php endif; ?>
    <?php if (isset($db_data['credentials'])): ?>
    <h3>Bought items:</h3>
    <article class="items_box">

        <?php foreach ($db_data['credentials'] as $user_index => $item): ?>
            <?php foreach ($item['buy_history'] as $item_selected): ?>

                <section class="item_box">
                    <span class="item_title"><?php print $item_selected['name']; ?></span>
                    <div class="item_image" style="background-image: url('<?php print $item_selected['image']; ?>')"></div>
                    <p class="item_price"><?php print $item_selected['price']; ?> Eur.</p>
                    <p class="item_description"><?php print $item_selected['description']; ?></p>
                </section>
<?php endforeach; ?>
        <?php endforeach; ?>

    </article>
    <?php else: ?>
    <span>List is empty.</span>
    <?php endif; ?>
</main>
</body>
</html>

