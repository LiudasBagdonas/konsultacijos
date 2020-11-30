<?php

require '../bootloader.php';

$nav = nav();

$db_data = file_to_array(DB_FILE);

if (isset($_POST['product_id'])) {

    foreach ($db_data['credentials'] as $user_index => $user) {
        if ($_SESSION['email'] === $user['email']) {
            foreach ($db_data['items'] as $item_index => &$item) {
                if ($item['id'] === $_POST['product_id']) {
                    $db_data['credentials'][$user_index]['user_selected'][] = $item;
                    $item['selected'] = true;
                }
            }
        }
    }
}
array_to_file($db_data, DB_FILE);
$db_data = file_to_array(DB_FILE);

$selected_items = selected_items();
$total_price = total_price();


$h1 = "My chart."
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
    <?php if (count($selected_items) === 0): ?>
        <h3>List is empty.</h3>
    <?php else: ?>
        <?php foreach ($selected_items as $item): ?>
            <section class="pvm_item_box">
                <div class="item_info_box">
                    <h4><?php print $item['name']; ?></h4>
                    <h5><?php print $item['price']; ?> Eur.</h5>
                    <p><?php print $item['description']; ?></p>
                </div>
                <div class="pvm_item_img" style="background-image: url('<?php print $item['image']; ?>')"></div>
            </section>
        <?php endforeach; ?>
        <section class="checkout_box">
            <p>Total price: <?php print $total_price; ?> Eur.</p>
            <form action="admin/myStuff.php" method="post">
                <button type="submit" name="checkout" value="true">Check out</button>
            </form>
        </section>
    <?php endif; ?>
</main>
</body>
</html>


