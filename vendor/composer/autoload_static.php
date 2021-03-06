<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit1f25d2c9c30b28e96b771dcb8a88c448
{
    public static $prefixLengthsPsr4 = array (
        'a' => 
        array (
            'app\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'app\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit1f25d2c9c30b28e96b771dcb8a88c448::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit1f25d2c9c30b28e96b771dcb8a88c448::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
