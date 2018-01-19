<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit7a5d787cb87624c70f1e018369e24b29
{
    public static $prefixLengthsPsr4 = array (
        'T' => 
        array (
            'Tests\\' => 6,
        ),
        'D' => 
        array (
            'Data\\' => 5,
        ),
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Tests\\' => 
        array (
            0 => __DIR__ . '/../..' . '/tests',
        ),
        'Data\\' => 
        array (
            0 => __DIR__ . '/../..' . '/data',
        ),
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit7a5d787cb87624c70f1e018369e24b29::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit7a5d787cb87624c70f1e018369e24b29::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}