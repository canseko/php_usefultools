<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit0cfc0fc8cca284a38faeb03d9eac3c2f
{
    public static $prefixLengthsPsr4 = array (
        'T' => 
        array (
            'Twilio\\' => 7,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Twilio\\' => 
        array (
            0 => __DIR__ . '/..' . '/twilio/sdk/src/Twilio',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit0cfc0fc8cca284a38faeb03d9eac3c2f::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit0cfc0fc8cca284a38faeb03d9eac3c2f::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit0cfc0fc8cca284a38faeb03d9eac3c2f::$classMap;

        }, null, ClassLoader::class);
    }
}
