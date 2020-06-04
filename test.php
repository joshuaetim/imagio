<?php
    
    require __DIR__.'/vendor/autoload.php';

    use Intervention\Image\ImageManagerStatic as Image;

    $img = Image::make('storage/2020MayMon050532Booking_Ninjas_app_Exchange.jpg');

    $img->brightness(90);

    echo $img->response();

?>