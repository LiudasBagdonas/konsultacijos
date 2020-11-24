<?php
require_once 'functions/constants.php';
require_once 'functions/functions.php';

$match_info = generate_match();
$detail = $match_info['location']. ', ' .$match_info['date']. ', '.$match_info['time'];
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
            <ul class="menu_left">
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
    <article class="poster_box">
        <section class="teams_logos_box">
            <div>
                <div class="team_logo" style="background-image: url(<?php print $match_info['teams'][0]['logo']; ?>)">
                </div>
                <p class="team_name_highlight">Jobanieji</p>
                <p class="teams_names"><?php print $match_info['teams'][0]['name']; ?></p>
            </div>

            <div class="vs">
                <h2>VS</h2>
            </div>
            <div>
                <div class="team_logo" style="background-image: url(<?php print $match_info['teams'][1]['logo']; ?>)">
                </div>
                <p class="team_name_highlight">Beviltiskieji</p>
                <p class="teams_names"><?php print $match_info['teams'][1]['name']; ?></p>
            </div>
        </section>
        <section class="poster_highlight_box">
            <h1 class="highlight">Jobanos sporto varzybos</h1>
        </section>
        <section class="match_details">
            <span><?php print $detail; ?>.</span>
        </section>
    </article>
</main>
</body>
</html>
