<?php

    require 'includes/auth_check.php';

    ini_set('max_execution_time', 300); // increase max execution time

    require __DIR__.'/vendor/autoload.php';

    $photo = new Photo;

    $auth = new Auth;

    $authQuery = $auth->getInfo($_SESSION['user'])->fetch();

    $username = $authQuery['username'];

    $userID = $authQuery['id'];

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

        $result = $photo->makeEdits($edits, $name, $location, $username);

        if($result)
        {
            if(isset($_POST['title']) && isset($_POST['id']) && !empty($_POST['title']) && !empty($_POST['id']))
            {
                $title = $_POST['title'];

                $id = $_POST['id'];

                $changeTitle = $photo->updateImage($id, $userID, $title);

                // echoSpace([$title, $id, $userID]);

                if($changeTitle > 0)
                {
                    echo '<p class="text-success">Changes made sucessfully</p>';
                }

                else
                {
                    echo '<p class="text-success">Image edited successfully.</p>';
                }
            }
        }
        else
        {
            echo '<p class="text-danger">Failed to make changes</p>';
        }

        // echo $name;
        //echoSpace([$blur, $grayscale, $brightness, $invert, $opacity, $location]);
    }

?>