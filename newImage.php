<?php

    ini_set('max_execution_time', 300);

    require __DIR__.'/vendor/autoload.php';

    $photo = new Photo;

    function echoSpace(array $items)
    {
        foreach($items as $key=>$value)
        {
            echo $value . ' ';
        }
    }

    if(isset($_POST['edit']))
    {
        $blur = $_POST['blur'];
        $grayscale = $_POST['grayscale'];
        $brightness = $_POST['brightness'] - 100;
        $invert = $_POST['invert'];
        $opacity = $_POST['opacity'];
        $location = $_POST['location'];

        $image = $photo->makeImage($location);

        if($grayscale > 0)
        {
            $edits = array(
                'blur' => $blur,
                'greyscale' => $grayscale,
                'brightness' => $brightness,
                'opacity' => $opacity,
                'invert' => $invert
            );
        }
        else
        {
            $edits = array(
                'blur' => $blur,
                'brightness' => $brightness,
                'opacity' => $opacity,
                'invert' => $invert
            );
        }

        $name = substr($location, strrpos($location, '/')+1);

        // echo $name;

        // print_r($edits);

        $result = $photo->makeEdits($edits, $name, $location);

        if($result)
        {
            echo 'Successful';
        }
        else
        {
            echo 'Failed';
        }

        // echo $name;
        //echoSpace([$blur, $grayscale, $brightness, $invert, $opacity, $location]);
    }

?>