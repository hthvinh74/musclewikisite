<?php
    require_once('database/exercise_db.php');

    $list_exercise = get_exercises_by_name();
    $input = strtolower($_POST['search'] ?? '');

    $filter = [];
    foreach($list_exercise as $e){
        $exercise = strtolower($e['exercise_name']);
        if(str_contains($exercise,$input)){
            $filter[] =  $exercise;
        }
    }
    echo json_encode($filter);
?>