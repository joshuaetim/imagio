<?php

require __DIR__.'/vendor/autoload.php';

    use League\Flysystem\Filesystem;
    use League\Flysystem\Adapter\Local;

    $adapter = new Local(__DIR__.'/storage');
    $filesystem = new Filesystem($adapter);

    $adapter = new Local(__DIR__.'/storage/'.'etim/thumbnails');
    $filesystem = new Filesystem($adapter);

    $filesystem->createDir('wow');


?>