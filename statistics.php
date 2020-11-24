<?php
require_once 'functions/constants.php';
require_once 'functions/functions.php';

$match = generate_match();
$matches = generate_matches(4);

foreach ($matches as &$match) {
    assign_scores_to_players($match);

}

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
    <h1>Teams</h1>
    <article class="teams_info">
        <?php foreach ($match['teams'] as $team): ?>
            <section>
                <h3><?php print $team['name']; ?></h3>
                <h4>Coach: <?php print $team['coach']; ?></h4>
                <p>Players count: <?php print count($team['players']); ?></p>
                <?php foreach ($team['players'] as $player): ?>
                    <p><?php print $player['name'] . ' ' . $player['surname'] . ' - ' . $player['position']; ?></p>
                <?php endforeach; ?>
            </section>
        <?php endforeach; ?>
    </article>
    <h1>Matches</h1>
    <article class="matches_info">
        <?php foreach ($matches as $match): ?>
            <section>
                <span><?php print $match['teams'][0]['name']; ?> - <?php print $match['teams'][1]['name']; ?></span>
                <span>   </span>
                <?php if (isset($match['result'])): ?>
                    <span><?php print $match['result'][0]; ?> : <?php print $match['result'][1]; ?></span>
                <?php else: ?>
                    <span><?php print $match['date']; ?>, <?php print $match['time']; ?>, <?php print $match['location']; ?></span>
                <?php endif; ?>
            </section>
        <?php endforeach; ?>
    </article>
    <h1>Points chart</h1>
    <article>
        <?php foreach ($matches as $match): ?>
            <section class="points_chart_match_box">
                <?php if (isset($match['result'])): ?>
                    <?php foreach ($match['teams'] as $team): ?>
                        <table>
                            <tr>
                                <th>Team Name:</th>
                                <th><?php print $team['name'];?></th>
                            </tr>
                            <tr>
                                <th>Points:</th>
                                <th>Player Name:</th>
                            </tr>
                            <?php foreach ($team['players'] as $player): ?>
                                <tr>
                                    <td><?php print $player['points'];?></td>
                                    <td><?php print $player['name'] . ' ' . $player['surname']; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </table>
                    <?php endforeach; ?>
                <?php endif; ?>
            </section>
        <?php endforeach; ?>
    </article>
    <h1>General information</h1>

</main>
</body>
</html>
