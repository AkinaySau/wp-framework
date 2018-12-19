<?php
/**
 * Created by PhpStorm.
 * User: sau
 * Date: 05.03.18
 * Time: 11:10
 */

namespace Sau\WP\Framework\Bundle\CarbonBundle\Carbon;


use Carbon_Fields\Container;

abstract class AbstractContainer implements ContainerInterface
{
    static protected $init = false;
    protected        $container;

    /**
     * Container constructor.
     *
     */
    final public function __construct()
    {
        add_action('carbon_fields_register_fields', function () {
            $this->init();
        });
    }

    private function init()
    {
        if (static::$init) {
            return;
        }
        static::$init    = true;
        $this->container = Container::make($this->getType(), $this->getTitle());
        $this->addFields();
    }

    abstract protected function addFields();

    /**
     * @return mixed
     */
    public function getInit()
    {
        return static::$init;
    }

}
