<?php

    require 'includes/auth_check.php';

    require __DIR__.'/vendor/autoload.php';

    $id = isset($_GET['id'])&&!empty($_GET['id']) ? $_GET['id'] : header('Location: index');

    $auth = new Auth;

    $authQuery = $auth->getInfo($_SESSION['user'])->fetch();

    $userID = $authQuery['id'];

    /* Instantiate object, get response in array form, split them in variables */

    $photo = new Photo;

    $imageCall = $photo->getSingleImage($id, $userID);

    $imageQuery = $imageCall[0];

    $imageCount = $imageCall[1];

    $imageDetails = $imageQuery->fetch();

    if($imageCount == 0)
    {
        header('Location: index');
    }

    /* AJAX CALL HANDLERS */

    if(isset($_POST['image']))
    {
        //sleep(0);
        echo '<img src="'.$imageDetails['thumbnail'].'" class="p-3" style="height:250px; width:500px">';
    }

    if(isset($_POST['blur']))
    {
        //sleep(2);
        $image = $imageDetails['location'];
        $result = $photo->blurImage($image);
        echo $result;
    }