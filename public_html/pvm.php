<?php
require '../bootloader.php';
$nav = nav();
$db_data = file_to_array(DB_FILE);


    foreach ($db_data['items'] as $item_index => &$item) {
        if ($item['id'] === $_POST['product_id']) {
            unset($db_data['selected']);
            $db_data['selected'][] = $item;
            unset($db_data['items'][$item_index]);
        }
    }

    array_to_file($db_data, DB_FILE);
$db_data = file_to_array(DB_FILE);
?>
<html>
<head>
    <title>Pvm</title>
    <link rel="stylesheet" href="">
    <link rel="stylesheet" href="media/styles.css">
</head>
<body>
<header>
    <?php require ROOT . './app/templates/nav.php'; ?>
</header>
<main>
    <h1>PVM saskaita-faktura</h1>
    <h2>PVM serija: <?php print rand(0000000000, 9999999999); ?></h2>
    <h3><?php print date('Y-m-d'); ?></h3>
    <?php foreach ($db_data['selected'] as $item_index => $item): ?>
<!--        --><?php //if ($item['id'] === $_POST['product_id']): ?>
            <section class="credentials_box">
                <div class="customer_box">
                    <h3>Pirkejas:</h3>
                    <?php foreach ($db_data['credentials'] as $cred_index => $user): ?>
                        <?php if ($_SESSION['email'] === $user['email']): ?>
                            <p><?php print $user['name'] . ' ' . $user['surname']; ?> </p>
                            <p><?php print $user['email']; ?></p>
                            <p><?php print $user['address']; ?></p>
                            <p><?php print $user['number']; ?></p>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
                <div class="seller_box">
                    <h3>Pardavejas:</h3>
                    <?php foreach ($db_data['credentials'] as $cred_index => $user): ?>
                        <?php if ($item['user'] === $user['email']): ?>
                            <p><?php print $user['name'] . ' ' . $user['surname']; ?> </p>
                            <p><?php print $user['email']; ?></p>
                            <p><?php print $user['address']; ?></p>
                            <p><?php print $user['number']; ?></p>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            </section>
            <section class="pvm_item_box">
                <div class="item_info_box">
                    <h4><?php print $item['name'];?></h4>
                    <h5><?php print $item['price'];?> Eur.</h5>
                    <p><?php print $item['description'];?></p>
                </div>
                <div class="pvm_item_img" style="background-image: url('<?php print $item['image'];?>')"></div>
            </section>
<!--        --><?php //endif; ?>
    <?php endforeach; ?>
</main>
</body>
</html>