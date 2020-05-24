<?php

    if(isset($_POST['command'])){
        $command = $_POST['command'];
        sleep(3);
        echo $command;
    }

    if(isset($_POST['madd'])){
        echo 'stupid';
    }
    

?>