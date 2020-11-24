<?php
date_default_timezone_set('Europe/Vilnius');
require_once 'constants.php';


function rand_value($names_array)
{
    $rand_name_index = rand(0, count($names_array) - 1);
    return $names_array[$rand_name_index];
}

function generate_player()
{
    $generated_player = [];
    $generated_player['name'] = rand_value(NAMES);
    $generated_player['surname'] = rand_value(SURNAMES);
    $generated_player['age'] = rand(18, 36);
    $generated_player['height'] = rand(175, 230);
    $generated_player['position'] = rand_value(POSITION_TYPES);

    return $generated_player;
}

function generate_team()
{
    $team = [];
    $team['name'] = ucwords(rand_value(TEAM_ADJECTIVES) . ' ' . rand_value(TEAM_NOUNS));
    $team['coach'] = ucwords(rand_value(NAMES) . ' ' . rand_value(SURNAMES));
    $team['logo'] = '/logos/img-' . rand(1, 120) . '.svg';

    $count = rand(7, 12);
    $shirt_numbers = generate_rand_num_arr($count);

    for ($i = 0; $i < $count; $i++) {
        $team['players'][] = generate_player();
        $team['players'][$i]['shirt_number'] = $shirt_numbers[$i];
    }

    return $team;
}

function generate_rand_num_arr($count)
{
    $rand_numb_arr = range(0, 99);
    shuffle($rand_numb_arr);

    return array_slice($rand_numb_arr, 0, $count);;
}

function generate_rand_date($start, $end)
{
    $min = strtotime($start);
    $max = strtotime($end);
    $value = mt_rand($min, $max);

    return date('Y-m-d', $value);
}

function generate_rand_time()
{

    $hours = rand(18, 22);
    $mins = rand(0, 1);

    if ($mins) {
        $mins = '00';
    } else {
        $mins = '30';
    }

    return "$hours:$mins";
}

function generate_score()
{

    return rand(50, 160) . ':' . rand(50, 160);
}

function teams_scores()
{
    $result = explode(':', generate_score());

    $teams_scores = [];

    $teams_scores[0] = $result[0];
    $teams_scores[1] = $result[1];

    return $teams_scores;
}

function generate_match()
{
    $date = generate_rand_date('2010-11-13', '2030-11-13');
    $time = generate_rand_time();
    $location = rand_value(CITIES);
    $team_one = generate_team();
    $team_two = generate_team();
    $result = teams_scores();


    $match_info = [
        'date' => $date,
        'time' => $time,
        'location' => $location,
        'teams' => [
            $team_one,
            $team_two,
        ],
        'result' => $result,
    ];

    if ($date >= date('Y-m-d')) {
        if ($time > date('H:m')) {
//            $result = 'Match has not yet come to pass';
            unset($match_info['result']);
        }
    }

    return $match_info;
}

function generate_teams($count)
{
    $teams = [];
    for ($i = 1; $i <= $count; $i++) {
        $teams[] = generate_team();
    }
    return $teams;
}

function team_players_count($team)
{
    return count($team['players']);
}

function teams_players_count(array $teams)
{
    $players = 0;

    foreach ($teams as $team) {
        $players += team_players_count($team);
    }
    return $players;
}

function count_average_players_count(array $teams)
{
    return round(teams_players_count($teams) / count($teams), 1);
}

function filter_by_players_count($teams, $count)
{
    $teams_list = [];
    foreach ($teams as $team) {
        if (team_players_count($team) === $count) {
            $teams_list[] = $team;
        }
    }
    return $teams_list;
}

function count_players_by_position($team, $position)
{
    $count = 0;

    foreach ($team['players'] as $player) {
        if ($player['position'] === $position) {
            $count += 1;
        }
    }
    return $count;
}

function list_players_by_position($team, $position)
{
    $players = [];

    foreach ($team['players'] as $player) {
        if ($player['position'] === $position) {
            $players[] = $player['name'] . ' ' . $player['surname'];
        }
    }
    return $players;
}

function filter_positions_in_teams($teams, $count, $position)
{
    $teams_list = [];

    foreach ($teams as $team) {

        if (count_players_by_position($team, $position) === $count) {
            $teams_list[] = $team;
        }

    }
    return $teams_list;
}

function players_of_one_position($teams, $position)
{
    $players_array = 0;

        foreach ($teams as $team) {
            $players_array += count_players_by_position($team, $position);
        }

    return $players_array;
}

function all_players_by_position($teams)
{
    $players_arr = [];

    foreach (POSITION_TYPES as $type) {
            $players_arr[$type] = players_of_one_position($teams, $type);
    }
    return $players_arr;
}

function most_popular_position($teams)
{
    $positions_popularity = all_players_by_position($teams);
    arsort($positions_popularity, SORT_NUMERIC);
    current($positions_popularity);

    return key($positions_popularity);
}

function assign_scores_to_players(&$match)
{
    if (isset($match['result'])) {
        $scores = teams_scores($match['result']);
        foreach ($scores as $key => $score) {
            for ($i = 0; $i < $score; $i++) {
                $player = &$match['teams'][$key]['players'][rand(0, count($match['teams'][$key]['players']) - 1)];
                if (isset($player['points'])) {
                    $player['points'] += 1;
                } else {
                    $player['points'] = 1;
                }
            }
        }
    }
}

function generate_matches($count)
{
    $matches = [];

    for ($i = 0; $i < $count; $i++) {
        $matches[] = generate_match();
    }

    return $matches;
}

function generate_scoreboard_array($match)
{
    $scoreboard_array = [];

    foreach ($match['teams'] as $team_index => $team) {
        $scoreboard_array[$team_index]['name'] = $team['name'];
        foreach ($team['players'] as $player_index => $player) {
            $scoreboard_array[$team_index]['players'][$player_index]['name'] = $player['name'];
            $scoreboard_array[$team_index]['players'][$player_index]['surname'] = $player['surname'];
            $scoreboard_array[$team_index]['players'][$player_index]['points'] = $player['points'];
        }
    }

    return $scoreboard_array;
}