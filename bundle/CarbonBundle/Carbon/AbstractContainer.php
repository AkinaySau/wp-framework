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
    protected $init = false;
    protected $container;

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

    public function init()
    {
        if ($this->getInit()) {
            return;
        }
        $this->init      = true;
        $this->container = Container::make($this->getType(), $this->getTitle());
        $this->addFields();
    }

    abstract protected function addFields();

    /**
     * @return mixed
     */
    public function getInit()
    {
        return $this->init;
    }

}
