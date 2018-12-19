<?php
/**
 * Created by PhpStorm.
 * User: AkinaySau(akinaysau@gmail.com)
 * Date: 18.12.18
 * Time: 12:47
 *
 * @package wp-framework
 */

namespace Sau\WP\Framework\Bundle\CarbonBundle\DependencyInjection;


use Sau\WP\Framework\Bundle\CarbonBundle\Carbon\AbstractContainer;
use Sau\WP\Framework\Bundle\CarbonBundle\Carbon\ContainerInterface;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

class CarbonExtension extends Extension
{

    /**
     * Loads a specific configuration.
     *
     * @throws \InvalidArgumentException When provided tag is not defined in this extension
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $container->registerForAutoconfiguration(ContainerInterface::class)
                  ->addTag('carbon.register');

        $loader = new YamlFileLoader($container, new FileLocator(\dirname(__DIR__).'/Resources/config'));

        $loader->load('services.yaml');

    }
}
