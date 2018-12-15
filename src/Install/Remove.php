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

class Remove
{
    use ManageTrait;

    /**
     * @param string $path absolute path to directory plugin or theme(use __DIR__ if install in init file).
     *                     If not use as MU-Plugin include .loader.php in your base file
     */
    public static function deactivate(string $path)
    {
        $fs = new Filesystem();
        $fs->remove(static::getPathToMULoader(static::getPluginDir($path)));
        header("Refresh:0"); #fix for refresh
    }
}
