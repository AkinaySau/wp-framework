<?php
/**
 * Created by PhpStorm.
 * User: AkinaySau(akinaysau@gmail.com)
 * Date: 19.12.18
 * Time: 17:07
 *
 * @package wp-framework
 */

namespace Sau\WP\Framework\Bundle\CarbonBundle\Loader;


use Sau\WP\Framework\Bundle\CarbonBundle\Carbon\ContainerInterface;

class CarbonLoader
{
    protected $collection;

    /**
     * @return ContainerInterface[]
     */
    public function getCollection()
    {
        return $this->collection;
    }

    /**
     * @param ContainerInterface $container
     */
    public function add(ContainerInterface $container): void
    {
        $this->collection[ get_class($container) ] = $container;
    }

    public function load()
    {
        add_action('carbon_fields_register_fields', function () {
            foreach ($this->getCollection() as $container) {
                $container->init();
            }
        });
    }
}
