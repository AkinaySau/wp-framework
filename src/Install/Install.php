<?php
/**
 * Created by PhpStorm.
 * User: AkinaySau(akinaysau@gmail.com)
 * Date: 15.12.18
 * Time: 12:28
 *
 * @package wp-framework
 */

namespace Sau\WP\Framework\Install;

use Symfony\Component\Filesystem\Filesystem;

/**
 * Instate framework
 * @package Sau\WP\Framework\Install
 */
class Install
{
    use ManageTrait;

    /**
     * @param string $path absolute path to directory plugin or theme(use __DIR__ if install in init file).
     *                     If not use as MU-Plugin include .loader.php in your base file
     */
    public static function install(string $path, bool $mu = true)
    {
        $path = realpath($path);
        $fs   = new Filesystem();
        static::copyLoader($path, $fs);
        static::copyEnv($path, $fs);
        if ($mu) {
            static::muLoader($path, $fs);
        }
    }

    static protected function copyLoader($path, Filesystem $fs)
    {
        $loader = static::getPathToLoader($path);
        if ( ! $fs->exists($loader)) {
            $fs->copy(static::getPathTemplate().'/.loader.php', $loader);
        }
        $defines = static::getPathToDefines($path);
        if ( ! $fs->exists($defines)) {
            $fs->copy(static::getPathTemplate().'/.defines.php', $defines);

        }
    }

    static protected function copyEnv($path, Filesystem $fs)
    {
        $env = $path.'/.env';
        $fs->copy(static::getPathTemplate().'/.env.dist', $path.'/.env.dist', true);
        if ( ! $fs->exists($env)) {
            $fs->copy(static::getPathTemplate().'/.env.dist', $env);
        }

    }

    public static function muLoader(string $path, Filesystem $fs)
    {
        $name      = static::getPluginDir($path);
        $loader    = static::getPathToLoader($path);
        $mu_loader = static::getPathToMULoader($name);

        if ($fs->exists($loader) && ! $fs->exists($mu_loader)) {
            $fs->symlink($loader, $mu_loader);
        }
    }


}
