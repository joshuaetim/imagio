<?php

    ini_set('max_execution_time', 300); // increase max execution time

    require __DIR__.'/vendor/autoload.php';

    $photo = new Photo;

    if(isset($_POST['edit']))
    {
        $blur = $_POST['blur'];
        $grayscale = $_POST['grayscale'];
        $brightness = $_POST['brightness'] - 100;
        $invert = $_POST['invert'];
        $opacity = $_POST['opacity'];
        $location = $_POST['location'];

        $image = $photo->makeImage($location);

        $edits = array(
                'blur' => $blur,
                'greyscale' => $grayscale,
                'brightness' => $brightness,
                'opacity' => $opacity,
                'invert' => $invert
            );

        $name = substr($location, strrpos($location, '/')+1);

        // echo $name;

        // print_r($edits);

        $result = $photo->makeEdits($edits, $name, $location);

        if($result)
        {
            echo '<p class="text-success">Changes made sucessfully</p>';
        }
        else
        {
            echo '<p class="text-danger">Failed to make changes</p>';
        }

        // echo $name;
        //echoSpace([$blur, $grayscale, $brightness, $invert, $opacity, $location]);
    }

?>