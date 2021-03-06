<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitbe5bbe90700faa2b2466ba22a4c6eba8
{
    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'Sonata\\GoogleAuthenticator\\' => 27,
        ),
        'G' => 
        array (
            'Google\\Authenticator\\' => 21,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Sonata\\GoogleAuthenticator\\' => 
        array (
            0 => __DIR__ . '/..' . '/sonata-project/google-authenticator/src',
        ),
        'Google\\Authenticator\\' => 
        array (
            0 => __DIR__ . '/..' . '/sonata-project/google-authenticator/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitbe5bbe90700faa2b2466ba22a4c6eba8::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitbe5bbe90700faa2b2466ba22a4c6eba8::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitbe5bbe90700faa2b2466ba22a4c6eba8::$classMap;

        }, null, ClassLoader::class);
    }
}
