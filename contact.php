<?php
$form_visibility = 'flex';
?>
<html>
<head>
    <title>Contact Us</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header>
    <article class="wrapper">
        <nav>
            <ul>
                <li>
                    <a href="index.php">Home</a>
                </li>
            </ul>
            <ul class="menu-right">
                <li>
                    <a href="teams.php">Teams</a>
                </li>
                <li>
                    <a href="contact.php">Contact Us</a>
                </li>
            </ul>
        </nav>
    </article>
</header>
<main>
    <?php if (isset($_POST['submit'])): ?>
        <?php $form_visibility = 'none'; ?>
        <span class="insult">Niekam nerupi tavo nuomone.</span>
    <?php endif; ?>
    <form method="POST" style="display: <?php print $form_visibility ;?>">
        <label for="name">Vardas:</label>
        <input name="name" type="text">
        <label for="email">El. Pastas:</label>
        <input name="email" type="email">
        <label for="">Zinute</label>
        <textarea name="message"></textarea>
        <button name="submit" type="submit">Siusti</button>
    </form>
</main>
</body>
</html>