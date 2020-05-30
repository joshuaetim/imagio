<?php

    require 'includes/auth_check.php';

    require __DIR__.'/vendor/autoload.php';

    use League\Flysystem\Filesystem;
    use League\Flysystem\Adapter\Local;
    
    $adapter = new Local(__DIR__);
    $filesystem = new Filesystem($adapter);

    $auth = new Auth;

    $query = $auth->getInfo($_SESSION['user'])->fetch();

    $photo = new Photo; // new photo handler class


    if(isset($_GET['token']) && $_GET['token'] == 'JoshSecretKey')
    {
        $photoID = $_GET['delete'];
        $thumb = urldecode($_GET['thumb']);
        $location = urldecode($_GET['location']);

        // echoSpace([$thumb, $location]);

        // $_SESSION['form_success'] = $photoID . ' <br> ' . $thumb . ' <br> ' . $location;

        $deleteHandle = $photo->deleteImage($photoID, $query['id']);
        
        if($deleteHandle > 0)
        {
            $fileDelete = $filesystem->delete($location);

            if($fileDelete)
            {
                $_SESSION['form_success'] = 'File successfully deleted';

                header("Location: index");
            }
        }
        else
        {
            $_SESSION['form_fail'] = 'Error in submission';
        }
    }

?>