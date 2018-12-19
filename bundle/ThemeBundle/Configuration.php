<?php
/**
 * Created by PhpStorm.
 * User: AkinaySau(akinaysau@gmail.com)
 * Date: 19.12.18
 * Time: 14:45
 *
 * @package wp-framework
 */

namespace Sau\WP\Framework\Bundle\ThemeBundle;


class Configuration
{
    private $configs;

    public function __construct(array $configs)
    {
        $this->configs = $configs;

    }

    /**
     * @return mixed
     */
    public function getConfig($name)
    {
        if (array_key_exists($name, $this->configs)) {
            return $this->configs[ $name ];
        }

        return null;
    }

    /**
     * All configs
     * @return mixed
     */
    public function getConfigs()
    {
        return $this->configs;
    }
}
