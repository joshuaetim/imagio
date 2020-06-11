<?php

    ob_start();

    require 'includes/auth_check.php';

    require __DIR__.'/vendor/autoload.php';

    $auth = new Auth;

    $query = $auth->getInfo($_SESSION['user'])->fetch();
    
    if(isset($_GET['root']) && !empty($_GET['root']))
    {
        // check if valid user operates the system

        $mainRoot = strpos($_GET['root'], '/');
        if($mainRoot)
        {
            $user = substr($_GET['root'], 0, $mainRoot);
            // die(var_dump($user));
        }
        else{
            $user = $_GET['root'];
            // die(var_dump($user));
        }

        if($user !== $query['username'])
        {
            header("Location: fatal");
        }
        

        $mainDir = $_GET['root'];
        $occur = strrpos($mainDir, '/');

        if($occur)
        {
            $oneUp = substr($mainDir, 0, $occur);
            
        }
    }
    else{
        $mainDir = $query['username'];
    }

    // return var_dump($query['username']);

    use League\Flysystem\Filesystem;
    use League\Flysystem\Adapter\Local;

    $adapter = new Local(__DIR__.'/storage');
    $filesystem = new Filesystem($adapter);

    $file = new File($adapter, $filesystem);

    $exists = $file->listAll($mainDir);

    if(!$exists)
    {
        header("Location: fatal");
    }
    elseif($exists == 'empty')
    {
        echo 'This directory is empty';
        die();
    }

    $directories = [];

    $files = [];

    $mainFiles = [];

    $subFiles = [];

    foreach($exists as $object)
    {
        if($object['type'] == 'dir')
        {
            $directories[] = ['name' => $object['basename'], 'path' => $object['path']];
        }

        if($object['type'] == 'file')
        {
            $files[] = ['name' => $object['basename'], 'path' => $object['path']];;
        }
    }

    foreach($directories as $key=>$value)
    {
        $path = $value['path'];
        $occur = strrpos($path, '/');

        if($occur)
        {
            $rem = substr($path, 0, $occur);
            if($rem == $mainDir)
            {
                $mainDirectories[] = ['path' => $path, 'name' => $value['name']];
            }
            else
            {
                $subDirectories[] = ['path' => $path, 'name' => $value['name']];
            }
        }
        
        echobr($value['path']);
    }

    echobr(' ');

    foreach($files as $key=>$value)
    {
        $path = $value['path'];
        $occur = strrpos($path, '/');

        if($occur)
        {
            $rem = substr($path, 0, $occur);
            if($rem == $mainDir)
            {
                $mainFiles[] = ['path' => $path, 'name' => $value['name']];
            }
            else
            {
                $subFiles[] = ['path' => $path, 'name' => $value['name']];
            }
        }

        echobr($value['path']);
    }

    echobr(' ');

    echobr('Direct files: ');

    print_r($mainFiles);

    echobr(' ');

    echobr('Sub files: ');

    print_r($subFiles);

    if(isset($_POST['addfolder']))
    {
        $adapter = new Local(__DIR__.'/storage/'.$mainDir);
        $filesystem = new Filesystem($adapter);
        $folder = trim($_POST['folder']);
        $dirCreate = $filesystem->createDir($folder);

        if($dirCreate)
        {
            $_SESSION['message'] = 'Folder created successfully';
        }
        else{
            $_SESSION['message'] = 'Error creating folder';
        }
        header("Location: test?root=".$mainDir);
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>Test</title>
</head>
<body>
    <div class="container p-3">
    <form action="test?root=<?=$_GET['root']?>" method="post">
    <?php
        if(isset($_SESSION['message']))
        {
            echo $_SESSION['message'] . '<br>';
            unset($_SESSION['message']);
        }
    ?>
        <input type="text" name="folder" placeholder="Folder name...">
        <input type="submit" value="New Folder" name="addfolder">
    </form>
    <?php
        if(isset($oneUp))
        {
            echo '<a href="?root='.$oneUp.'">Go up one folder</a>';
        }
    ?>
        <div class="row" id="nice">

        <?php
            if(!empty($mainDirectories)){
            foreach($mainDirectories as $key=>$value)
            {
                $dirName = $value['name'];
                $limit = 8;

                if(strlen($fileName) > $limit)
                {
                    $dirName = substr($dirName, 0, $limit) . '...';
                }
                ?>
                
                    <div class="col-md-2 p-3 text-center">
                        <a href="?root=<?=$mainDir.'/'.$value['name']?>">
                            <svg class="bi bi-folder" width="3em" height="3em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path d="M9.828 4a3 3 0 0 1-2.12-.879l-.83-.828A1 1 0 0 0 6.173 2H2.5a1 1 0 0 0-1 .981L1.546 4h-1L.5 3a2 2 0 0 1 2-2h3.672a2 2 0 0 1 1.414.586l.828.828A2 2 0 0 0 9.828 3v1z"/>
                            <path fill-rule="evenodd" d="M13.81 4H2.19a1 1 0 0 0-.996 1.09l.637 7a1 1 0 0 0 .995.91h10.348a1 1 0 0 0 .995-.91l.637-7A1 1 0 0 0 13.81 4zM2.19 3A2 2 0 0 0 .198 5.181l.637 7A2 2 0 0 0 2.826 14h10.348a2 2 0 0 0 1.991-1.819l.637-7A2 2 0 0 0 13.81 3H2.19z"/>
                            </svg>
                            <p class="text-center"><?=$dirName?></p>
                        </a>
                        
                    </div>
               

                <?php
            }
        }
            foreach($mainFiles as $key=>$value)
            {
                $fileName = $value['name'];
                $limit = 8;

                if(strlen($fileName) > $limit)
                {
                    $fileName = substr($fileName, 0, $limit) . '...';
                }
                ?>
                    <div class="col-md-2 p-3 text-center" title="<?=$value['name']?>">
                    <a href="storage/<?=$value['path']?>" target="_blank">
                        <svg class="bi bi-image" width="3em" height="3em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M14.002 2h-12a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1zm-12-1a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2h-12z"/>
                            <path d="M10.648 7.646a.5.5 0 0 1 .577-.093L15.002 9.5V14h-14v-2l2.646-2.354a.5.5 0 0 1 .63-.062l2.66 1.773 3.71-3.71z"/>
                            <path fill-rule="evenodd" d="M4.502 7a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3z"/>
                        </svg>
                        <p class="text-center"><?=$fileName?></p>
                    </a>
                    </div>
                <?php
            }
        ?>
         </div>
    </div>
    <!-- <script>
    var corner = document.getElementById('nice');
    if (corner.addEventListener) {
  corner.addEventListener('contextmenu', function(e) {
    alert("You've tried to open context menu"); //here you draw your own menu
    e.preventDefault();
  }, false);
} else {
  corner.attachEvent('oncontextmenu', function() {
    alert("You've tried to open context menu");
    window.event.returnValue = false;
  });
}
</script> -->
</body>
</html>