<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitb0d4cd61e7134dff01ee22b87a70ad4e
{
    public static $prefixesPsr0 = array (
        'p' => 
        array (
            'phemto' => 
            array (
                0 => __DIR__ . '/..' . '/phemto/phemto/src',
            ),
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixesPsr0 = ComposerStaticInitb0d4cd61e7134dff01ee22b87a70ad4e::$prefixesPsr0;

        }, null, ClassLoader::class);
    }
}
