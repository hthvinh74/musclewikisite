<?php
    require_once('connection.php');

    function get_exercises($muscle_group){
        $connection = create_connection();
        $sql = 'select * from exercises where muscle_group = ?';

        $stm = $connection->prepare($sql);
        $stm->bind_param('s',$muscle_group);

        if(!$stm->execute()) return array('code' => 1, 'message' => 'Cannot execute command!');

        $result = $stm->get_result();
        $data = array();

        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }

        return $data;
    }

    function get_exercises_by_name(){
        $connection = create_connection();
        $sql = 'select exercise_name,key_exercise,muscle_group from exercises';

        $stm = $connection->prepare($sql);

        if(!$stm->execute()) return array('code' => 1, 'message' => 'Cannot execute command!');

        $result = $stm->get_result();
        $data = array();

        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }

        return $data;
    }
?>