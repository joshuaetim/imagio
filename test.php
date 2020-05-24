<?php

require __DIR__.'/vendor/autoload.php';

use Intervention\Image\ImageManagerStatic as Image;

$location = 'http://localhost/intervention/storage/2020MaySat110514home-office-336373_1920.jpg';

$img = Image::make($location);
$img->greyscale(100);
$img->save('storage/cool.jpg');
echo $img->response('jpg');
?>