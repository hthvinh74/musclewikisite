<?php
    require_once('database/exercise_db.php');

    $get_exercise = get_exercises_by_name();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MuscleWikiSon</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
    <link rel="stylesheet" href="./assets/css/style.css">
    <link rel="stylesheet" href="./assets/css/responsive.css">
    <link rel="shortcut icon" href="./assets/img/icons8-gym-50.png" type="image/x-icon">
    <link rel="stylesheet" href="./assets/img/fontawesome-free-6.4.0-web/css/all.min.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css" rel="stylesheet"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.js"></script>
</head>
<body>
    <!-- Header  -->
    <div class="main-header">
        <!-- nav bar  -->
        <div class="nav wrapper">
            <!-- logo  -->
            <a href="./index.php" class="logo">MUSCLE<span>WIKISON</span></a>

            <!-- search box  -->
            <div class="search-container">
                <input id="search" type="search" name="q" placeholder="e.g., traps, shoulder">
                <i class="fa-solid fa-magnifying-glass mglass"></i>
                <ul class="rcm-list" id="rcm-list">
                    
                </ul>
            </div>
        </div>
    </div>

    <!-- Body  -->
    <div class="main-body wrapper">
        <div class="training-list-box">
            <ul class="title-box"> 
                <h2>Self - trainning List</h2>

                <a href="./doing_exercise.php?muscle_group=traps"><li class="box-items">Traps</li></a>
                <a href="./doing_exercise.php?muscle_group=shoulders"><li class="box-items">Shoulders</li></a>
                <a href="./doing_exercise.php?muscle_group=chest"><li class="box-items">Chest</li></a>
                <a href="./doing_exercise.php?muscle_group=biceps"><li class="box-items">Biceps</li></a>
                <a href="./doing_exercise.php?muscle_group=abdominals"><li class="box-items">Abdominals</li></a>
                <a href="./doing_exercise.php?muscle_group=obliques"><li class="box-items">Obliques</li></a>
                <a href="./doing_exercise.php?muscle_group=forearms"><li class="box-items">Forearms</li></a>
                <a href="./doing_exercise.php?muscle_group=quads"><li class="box-items">Quads</li></a>
                <a href="./doing_exercise.php?muscle_group=calves"><li class="box-items">Calves</li></a>
            </ul>
        </div>
    </div>

    <!-- Footer  -->
    <div class="footer">
        <p>&copy; Copyright 2023 MuscleWikisSon</p>
        <p>Some Rights Reserved</p>
        <span>Simplify your workout. <i class="fa-solid fa-check"></i></span>
    </div>

</body>

<script>
    
        const inputValue = document.getElementById('search');
        const list = document.getElementById('rcm-list');

        inputValue.addEventListener("input", function(event) {
            var searchValue = inputValue.value;
            $.ajax({
                type: "POST",
                url: "/search.php",
                data: { search: searchValue },
                success: function(result) {
                    list.innerHTML = '';
                    const filters = JSON.parse(result);
                    filters.forEach(c => {
                        const li = document.createElement('li');
                        const a = document.createElement('a');
                        li.className = 'rcm-list-item';

                        const exercises = <?php echo json_encode($get_exercise); ?>;
                        
                        exercises.forEach(exercise => {
                            const lowerCaseExercisesName = exercise.exercise_name.toLocaleLowerCase('de-DE'); 
                            if(c === lowerCaseExercisesName){
                                a.href = '/doing_exercise.php?muscle_group=' + encodeURIComponent(exercise.muscle_group);
                                a.textContent = exercise.exercise_name;
                            }
                            li.appendChild(a);
                        })
                        
                        list.appendChild(li);

                    });
                }
            });
        });
</script>
</html>
