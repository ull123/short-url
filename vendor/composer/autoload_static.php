<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit570d0f4733addd8728fb17a6e8328167
{
    public static $prefixLengthsPsr4 = array (
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app',
        ),
    );

    public static $classMap = array (
        'App\\Services\\Router' => __DIR__ . '/../..' . '/app/Services/Router.php',
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit570d0f4733addd8728fb17a6e8328167::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit570d0f4733addd8728fb17a6e8328167::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit570d0f4733addd8728fb17a6e8328167::$classMap;

        }, null, ClassLoader::class);
    }
}