<?php
/**
 * Created by PhpStorm.
 * User: AkinaySau(akinaysau@gmail.com)
 * Date: 15.12.18
 * Time: 16:50
 *
 * @package wp-framework
 */

namespace Sau\WP\Framework\Install;


trait ManageTrait
{
    /**
     * @param string $path
     *
     * @return string
     */
    public static function getPluginDir(string $path)
    {
        return basename($path);
    }

    /**
     * Get path to loader file
     *
     * @param $path
     *
     * @return string
     */
    static protected function getPathToLoader($path)
    {
        return realpath($path).'/.loader.php';
    }

    /**
     * Get path to define file
     *
     * @param $path
     *
     * @return string
     */
    static protected function getPathToDefines($path)
    {
        return realpath($path).'/.defines.php';
    }

    /**
     * Get path to MU loader file
     *
     * @param $name
     *
     * @return string
     */
    static protected function getPathToMULoader($name)
    {
        return WPMU_PLUGIN_DIR.'/.'.$name.'.php';
    }

    static protected function getPathTemplate()
    {
        return realpath(__DIR__.'/../../templates/');
    }
}
