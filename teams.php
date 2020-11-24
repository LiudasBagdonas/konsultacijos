<?php
require_once 'functions/constants.php';
require_once 'functions/functions.php';
$team1 = generate_team();
$team2 = generate_team();

?>
<html>
<head>
    <title>Konsultacija</title>
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
                    <a href="statistics.php">Statistics</a>
                </li>
                <li>
                    <a href="contact.php">Contact Us</a>
                </li>
            </ul>
        </nav>
    </article>
</header>
<main>
    <article class="main_block">
        <h1 class="about_header">Teams Information</h1>
        <article class="teams_box">
            <section class="team1_box">
                <h2><?php print $team1['coach']; ?></h2>
                <div class="coach1_img"></div>
                <?php foreach ($team1['players'] as $player_index => $player): ?>
                    <div class="team1_player_info">
                        <p class="player_name"><?php print $player['name'] . ' ' . $player['surname']; ?></p>
                        <p class="player_age"><?php print $player['age'] . ' years'; ?></p>
                        <p class="player_height"><?php print $player['height'] . ' cm'; ?></p>
                        <p class="player_position">Position: <b><?php print $player['position']; ?></b></p>
                        <p class="player_number">Number: <?php print $player['shirt_number']; ?></p>
                    </div>
                <?php endforeach; ?>
            </section>
            <section class="team2_box">
                <h2><?php print $team2['coach']; ?></h2>
                <div class="coach2_img"></div>
                <?php foreach ($team2['players'] as $player_index => $player): ?>
                    <div class="team2_player_info">
                        <p class="player_name"><?php print $player['name'] . ' ' . $player['surname']; ?></p>
                        <p class="player_age"><?php print $player['age'] . ' years'; ?></p>
                        <p class="player_height"><?php print $player['height'] . ' cm'; ?></p>
                        <p class="player_position">Position: <b><?php print $player['position']; ?></b></p>
                        <p class="player_number">Number: <?php print $player['shirt_number']; ?></p>
                    </div>
                <?php endforeach; ?>
            </section>
        </article>
    </article>

</main>
</body>
</html>
