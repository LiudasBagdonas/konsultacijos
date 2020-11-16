<?php
date_default_timezone_set('Europe/Vilnius');
require_once 'constants.php';
require_once 'constants.php';


function rand_value($names_array) {
    $rand_name_index =  rand(0, count($names_array) - 1);
    return $names_array[$rand_name_index];
}

function generate_player() {
    $generated_player = [];
    $generated_player['name'] = rand_value(NAMES);
    $generated_player['surname'] = rand_value(SURNAMES);
    $generated_player['age'] = rand(18, 36);
    $generated_player['height'] = rand(175, 230);
    $generated_player['position'] = rand_value(POSITION_TYPES);

    return $generated_player;
}

function generate_team() {
    $team = [];
        $team['name'] = ucwords(rand_value(TEAM_ADJECTIVES) . ' ' . rand_value(TEAM_NOUNS));
        $team['coach'] = ucwords(rand_value(NAMES) . ' ' . rand_value(SURNAMES));
        $team['logo'] = '/logos/img-'.rand(1, 120).'.svg';

    $count = rand(7,12);
    $shirt_numbers = generate_rand_num_arr($count);

        for ($i = 0; $i < $count; $i++) {
            $team['players'][] = generate_player();
            $team['players'][$i]['shirt_number'] = $shirt_numbers[$i];        }

    return $team;
}

function generate_rand_num_arr($count) {
    $rand_numb_arr = range(0,99);
    shuffle($rand_numb_arr);

    return array_slice($rand_numb_arr, 0, $count);;
}

function generate_rand_date($start, $end){
    $min = strtotime($start);
    $max = strtotime($end);
    $value = mt_rand($min, $max);

    return date('Y-m-d', $value);
}

function generate_rand_time() {

    $hours = rand(18, 22);
    $mins = rand(0,1);

    if ($mins) {
        $mins = '00';
    } else {
        $mins = '30';
    }

   return "$hours:$mins";
}

function generate_score() {

    return rand(50,160).':'.rand(50,160);
}

function teams_scores() {
    $result = explode(':', generate_score());

    $teams_scores = [];

    $teams_scores['team1'] = $result[0];
    $teams_scores['team2'] = $result[1];

return $teams_scores;
}

function generate_match() {
    $date = generate_rand_date('2010-11-13', '2030-11-13');
    $time = generate_rand_time();
    $location = rand_value(CITIES);
    $team_one = generate_team();
    $team_two = generate_team();
    $result = teams_scores();

    if ($date >= date('Y-m-d')){
       if($time > date('H:m')) {
           $result = 'Match has not yet come to pass';
       }
    }

    $match_info =[
        'date' => $date,
        'time' => $time,
        'location' => $location,
        'teams' => [
            $team_one,
            $team_two,
        ],
        'result' => $result,
    ];

    return $match_info;
}