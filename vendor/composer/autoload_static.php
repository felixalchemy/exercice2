<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit7a5d787cb87624c70f1e018369e24b29
{
    public static $prefixLengthsPsr4 = array (
        'T' => 
        array (
            'Tests\\App\\Users\\' => 16,
            'Tests\\App\\Products\\' => 19,
            'Tests\\App\\Basket\\' => 17,
            'Tests\\App\\' => 10,
            'Tests\\' => 6,
        ),
        'D' => 
        array (
            'Data\\' => 5,
        ),
        'A' => 
        array (
            'App\\Users\\' => 10,
            'App\\Router\\' => 11,
            'App\\Products\\' => 13,
            'App\\Page\\Shop\\' => 14,
            'App\\Page\\CheckOut\\' => 18,
            'App\\Page\\Authentication\\' => 24,
            'App\\Page\\' => 9,
            'App\\Basket\\' => 11,
            'App\\Authentication\\' => 19,
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Tests\\App\\Users\\' => 
        array (
            0 => __DIR__ . '/../..' . '/tests/app/users',
        ),
        'Tests\\App\\Products\\' => 
        array (
            0 => __DIR__ . '/../..' . '/tests/app/products',
        ),
        'Tests\\App\\Basket\\' => 
        array (
            0 => __DIR__ . '/../..' . '/tests/app/basket',
        ),
        'Tests\\App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/tests/app',
        ),
        'Tests\\' => 
        array (
            0 => __DIR__ . '/../..' . '/tests',
        ),
        'Data\\' => 
        array (
            0 => __DIR__ . '/../..' . '/data',
        ),
        'App\\Users\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app/users',
        ),
        'App\\Router\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app/router',
        ),
        'App\\Products\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app/products',
        ),
        'App\\Page\\Shop\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app/page/shop',
        ),
        'App\\Page\\CheckOut\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app/page/checkout',
        ),
        'App\\Page\\Authentication\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app/page/authentication',
        ),
        'App\\Page\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app/page',
        ),
        'App\\Basket\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app/basket',
        ),
        'App\\Authentication\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app/authentication',
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
