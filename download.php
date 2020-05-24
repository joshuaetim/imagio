<?php

if(isset($_GET['photo']) && !empty($_GET['photo'])){
    $file = urldecode($_GET['photo']);
    $check = preg_match('/^[^.][ a-zA-Z0-9\.\/\-\_]+[a-z0-9]$/i', $file);

    if($check){
        $path = basename($file);
        if(file_exists(__DIR__. DIRECTORY_SEPARATOR .$file)){
            $mime = ($mime = getimagesize($file)) ? $mime['mime'] : $mime;
            $fp = fopen($file, 'rb');
            $size = filesize($file);
            if($mime){
                header("Content-Type: " . $mime);
                header("Content-Length: " . $size);
                header("Content-Disposition: attachment; filename=".$path);
                header("Content-Transfer-Encoding: binary");
                header("Cache-Control: revalidate");
                fpassthru($fp);
                header("Location: index");
                die();
            }
            else{
                die('File type error');
            }
        }
        else{
            die(__DIR__. DIRECTORY_SEPARATOR .$file . " doesn't exist");
        }
    }
    else{
        echo 'Invalid file name ' . $file;
    }
}

else{
    header("Location: fatal");
}

?>