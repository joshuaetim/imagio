<?php

    require 'includes/auth_check.php';

    require __DIR__.'/vendor/autoload.php';

    $auth = new Auth;

    $query = $auth->getInfo($_SESSION['user'])->fetch();

    use League\Flysystem\Filesystem;
    use League\Flysystem\Adapter\Local;
    

    $adapter = new Local(__DIR__.'/storage');
    $filesystem = new Filesystem($adapter);

    $formTitle = '';

    if(isset($_POST['addimage'])){

        if(!isset($_POST['user_id'])){
            header("Location: fatal");
        }
        
        if(!empty($_FILES['image']['name']) && !empty($_POST['title'])){

            $title = $_POST['title'];

            $upload = new Upload; // instantiating object from upload class

            // get status of file upload and specify action
            $status = $upload->getStatus($_FILES['image']);

            if($status){

                $checkImg = $upload->checkImg($_FILES['image']); // check if it's an image

                if($checkImg){

                    $details = $upload->getDetails($_FILES['image']);
                    $filename = $query['username'].'/'.date("YMDhms").$details['name'];
                    $thumbLocation = 'storage/'.$query['username'].'/thumbnails/'.date("YMDhms").$details['name'];

                    // store image with flysystem
                    $stream = fopen($details['temp'], 'r+');
                    $copy = $filesystem->writeStream($filename, $stream);

                    if(is_resource($stream)){
                        fclose($stream);
                    }
                    if($copy){

                        $photo = new Photo;

                        $location = 'storage/'.$filename;

                        // resize image for thumbnail

                        $thumbnail = $photo->createThumb($location, $thumbLocation);

                        /* Make location name, instantiate Photo class, and add to database */

                        $userId = $_POST['user_id'];
                        $add = $photo->addImage($title, $location, $userId, $thumbnail);

                        if($add == 1){
                            $_SESSION['upload_success'] = "Uploaded and added to database";
                            header("Location: index");
                        }
                        else{
                            $error = "File uploaded, but there's an error in adding to database.";
                        }

                    }
                    else{
                        $error = 'Error in storing image';
                    }
                }
                else{
                    $error = "The file must be an image (jpg, png, gif)";
                }

            }
            else{
                $error = "Error in uploading. Check the file size";
            }

        }
        else{
            $error = 'File or title field must not be empty';
        }

    }

?>

    <?php 
    $title = 'Add Image - Imagio';
    include('includes/nav.php') ?>
    <div class="container">
        <h3 class="p-3">Add New Image</h3>
        <div class="row">
            <div class="col-md-8">
                <form action="addimage" method="POST" class="container p-2" enctype="multipart/form-data">
                    <p>
                        <?php
                            if(isset($error)){
                                echobr($error);
                            }
                        ?>
                    </p>
                    <input type="hidden" name="user_id" value="<?=$query['id']?>">
                    <div class="form-group">
                        <label for="file">Upload File</label>
                        <input type="hidden" name="MAX_FILE_SIZE" value="1024000">
                        <input type="file" name="image" id="" class="form-control-file border">
                    </div>
                    <div class="form-group">
                        <label for="name">Image Title</label>
                        <input type="text" name="title" class="form-control" value="<?=$formTitle?>">
                    </div>
                    <p>
                        <input type="submit" value="Upload" name="addimage" class="btn btn-warning">
                    </p>
                </form>
            </div>
        </div>
    </div>
</body>
</html>