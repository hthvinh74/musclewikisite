<?php
    require_once('database/exercise_db.php');
    

    if(isset($_GET['muscle_group'])){
        $muscle_group = $_GET['muscle_group'];
        $data = get_exercises($muscle_group);
    }

    $get_exercise = get_exercises_by_name();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MuscleWikiSon: <?= ucfirst($muscle_group) ?></title>

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
            <a href="./index.php" class="logo">MUSCLE<span>WIKISSON</span></a>

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
        <!-- title exercise  -->
        <h2 class="body-title">
            <?= ucfirst($muscle_group) ?>
        </h2>
        <!-- Exercise  -->
        <?php
            foreach($data as $d){?>
                <div class="ex-des">
                    <h2><?= $d['exercise_name']?></h2>
                    <p><strong>Difficult: </strong><?= $d['difficult']?></p>

                    <h3>Equipment require: <?php
                        if($d['equipment']=='no'){?>
                            No
                        <?php
                        }
                    ?></h3>
                    <?php if($d['equipment']!='no'){?>
                        <img src="./assets/img/equipment/<?= $d['equipment']?>.jpg" alt="barbell">

                    <?php
                    }
                    ?>
                    
                    <h3>Guide:</h3>
                    <ul>
                        <?php
                            $guide = str_replace(';','-',$d['guide']);
                            $guide = explode('-', $guide);
                            for($i = 1; $i <= count($guide); $i++){?>
                                <li>
                                    <i class="fa-solid fa-<?= $i?>"></i>
                                    <?= $guide[$i-1]?>              
                                </li>
                        <?php
                            }
                        ?>
                    </ul>
                </div>

                <!-- video exer  -->
                <a class="vid-exer" href="./assets/video_exercise/<?=$d['key_exercise']?>.mp4"> 
                    <video class="video" preload="metadata" autoplay loop muted src="./assets/video_exercise/<?=$d['key_exercise']?>.mp4"></video>
                </a>
        <?php
            }
        ?>        
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