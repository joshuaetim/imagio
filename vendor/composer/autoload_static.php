<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitc59bcaae2c79e9d301b3044e27f5756d
{
    public static $files = array (
        '7b11c4dc42b3b3023073cb14e519683c' => __DIR__ . '/..' . '/ralouphie/getallheaders/src/getallheaders.php',
        'a0edc8309cc5e1d60e3047b5df6b7052' => __DIR__ . '/..' . '/guzzlehttp/psr7/src/functions_include.php',
    );

    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'Psr\\Http\\Message\\' => 17,
        ),
        'L' => 
        array (
            'League\\Flysystem\\' => 17,
        ),
        'I' => 
        array (
            'Intervention\\Image\\' => 19,
        ),
        'G' => 
        array (
            'GuzzleHttp\\Psr7\\' => 16,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Psr\\Http\\Message\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/http-message/src',
        ),
        'League\\Flysystem\\' => 
        array (
            0 => __DIR__ . '/..' . '/league/flysystem/src',
        ),
        'Intervention\\Image\\' => 
        array (
            0 => __DIR__ . '/..' . '/intervention/image/src/Intervention/Image',
        ),
        'GuzzleHttp\\Psr7\\' => 
        array (
            0 => __DIR__ . '/..' . '/guzzlehttp/psr7/src',
        ),
    );

    public static $classMap = array (
        'Auth' => __DIR__ . '/../..' . '/Classes/auth.php',
        'Database' => __DIR__ . '/../..' . '/Classes/db.php',
        'File' => __DIR__ . '/../..' . '/Classes/File.php',
        'Photo' => __DIR__ . '/../..' . '/Classes/photo.php',
        'Upload' => __DIR__ . '/../..' . '/Classes/upload.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitc59bcaae2c79e9d301b3044e27f5756d::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitc59bcaae2c79e9d301b3044e27f5756d::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitc59bcaae2c79e9d301b3044e27f5756d::$classMap;

        }, null, ClassLoader::class);
    }
}
