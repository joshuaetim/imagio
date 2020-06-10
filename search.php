<?php

    if(!isset($_GET['search']) or empty(trim($_GET['search'])))
    {
        header("Location: index.php");
    }

    $term = htmlspecialchars($_GET['search']);

    require 'includes/auth_check.php';

    require __DIR__.'/vendor/autoload.php';

    use League\Flysystem\Filesystem;
    use League\Flysystem\Adapter\Local;
    
    $adapter = new Local(__DIR__);
    $filesystem = new Filesystem($adapter);

    $auth = new Auth;

    $query = $auth->getInfo($_SESSION['user'])->fetch();

    $photo = new Photo; // new photo handler class

    $getPhoto = $photo->searchImages($term, $query['id']);

    $count = $getPhoto[1];

    $photoArray = $getPhoto[0];

    /* C0de to delete Photo from DB and from File system */

    if(isset($_POST['delete']))
    {
        $thumb = urlencode($_POST['thumb']);
        $location = urlencode($_POST['location']);

        header("Location: delete.php?token=JoshSecretKey&delete={$_POST['delete']}&thumb={$thumb}&location={$location}");
    }

    function checkSessionSet($name, $condition)
    {
        if(isset($_SESSION[$name]))
        {
            echo '<div class="alert alert-'.$condition.' alert-dismissible fade show">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    '. $_SESSION[$name] .'
                </div>';
            unset($_SESSION[$name]);
        }
    }

?>

    
    <?php 
    $title = 'Search - Imagio';
    include('includes/nav.php'); 
    ?>
    
    <div class="container p-4">
        
        <p>
            <?php
                checkSessionSet('upload_success', 'success');
                checkSessionSet('form_success', 'success');
                checkSessionSet('form_fail', 'danger');
            ?>
        </p>
        <p>
            <?php
                if($count < 1){
                    echo 'No image found';
                }
                else{
            ?>
        </p>
        <div class="row justift-content-center main">
            <?php
                foreach($photoArray as $photo)
                {
            ?>
            <div class="col-md-4 col-sm-12 pb-3">
                <div class="card">
                    <a href="<?=$photo['location']?>" target="_blank">
                        <img src="<?=$photo['thumbnail']?>" alt="" class="card-img-top" style="height: 200px; cursor: zoom-in;">
                    </a>
                    <div class="card-body">
                        <h5><?=$photo['title']?></h5>
                        <div class="btn-group">
                        <a href="download?photo=<?=urlencode($photo['location'])?>" class="btn btn-success">Download</a>
                        <a href="editimage.php?id=<?=$photo['id']?>" type="button" class="btn btn-primary">Edit</a>
                        <button type="button" class="btn btn-danger download" data-toggle="modal" data-target="#myModal<?=$photo['id']?>">Delete</button>
                        <div class="container">

                            <!-- The Modal -->
                            <div class="modal fade" id="myModal<?=$photo['id']?>">
                                <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                
                                    <!-- Modal Header -->
                                    <div class="modal-header">
                                    <h4 class="">Confirm Delete?</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    
                                    <!-- Modal body -->
                                    <div class="modal-body">
                                    <p>This action cannot be undone</p>
                                    <a href="#" class="btn btn-danger" onclick="submitForm('delete<?=$photo['id']?>')">Delete</a>
                                    <a href="#" class="btn btn-primary ml-3" data-dismiss="modal">Go Back</a>
                                    <form action="index" class="form-inline hide" name="delete<?=$photo['id']?>" method="POST">
                                    <input type="hidden" name="delete" value="<?=$photo['id']?>">
                                    <input type="hidden" name="thumb" value="<?=$photo['thumbnail']?>">
                                    <input type="hidden" name="location" value="<?=$photo['location']?>">
                                    </form>
                                    </div>
                                    
                                </div>
                                </div>
                            </div>
                            
                        </div>
                        
                        
                        </div>
                    </div>
                </div>
            </div>
            <?php
            
                }
            }
                    
            ?>
        </div>
    </div>
    


    <script>
        $(document).ready(function(){
            // $.ajax('getData.php', {
            //     type: "POST",
            //     data: {getData: 'data'},
            //     success: function(data, status){
            //         $(".main").html(data);
            //     }
            // });
        });
        function submitForm(name){
            event.preventDefault();
            var x = document.getElementsByName(name);
            return x[0].submit();
            //return alert(name);
        }
    </script>
</body>
</html>