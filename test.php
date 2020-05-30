<?php
    
    require __DIR__.'/vendor/autoload.php';

    use Intervention\Image\ImageManagerStatic as Image;

    $img = Image::make('storage/2020MayFri1105542020Apr271104121fungi.jpg');

    echo $img->response();

?>