<?php
/**
 * Created by PhpStorm.
 * User: AkinaySau(akinaysau@gmail.com)
 * Date: 18.12.18
 * Time: 12:32
 *
 * @package wp-framework
 */

namespace Sau\WP\Framework\Bundle\CarbonBundle\Carbon;


class ContainerChain
{

    private $containers;

    public function __construct()
    {
        $this->containers = [];
    }

    public function addContainer(AbstractContainer $container)
    {
        $this->containers[ get_class($container) ] = new $container;
    }

    public function getContainer($class): AbstractContainer
    {
        if (array_key_exists($class, $this->containers)) {
            return $this->containers[ $class ];
        }
    }
}
