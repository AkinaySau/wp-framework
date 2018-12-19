<?php
/**
 * Created by PhpStorm.
 * User: AkinaySau(akinaysau@gmail.com)
 * Date: 19.12.18
 * Time: 10:30
 *
 * @package wp-framework
 */

namespace Sau\WP\Framework\Bundle\ThemeBundle\DependencyInjection;


use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

class ThemeExtension extends Extension
{
    /**
     * Loads a specific configuration.
     *
     * @throws \InvalidArgumentException When provided tag is not defined in this extension
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        /**
         * load configs
         */
        $loader = new YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yaml');

        $configuration = new Configuration();

        $configs = $this->processConfiguration($configuration, $configs);

        if ( ! $container->has('theme.configuration')) {
            $configurationDefinition = new Definition(\Sau\WP\Framework\Bundle\ThemeBundle\Configuration::class,
                [$configs]);
            $configurationDefinition->setPublic(true);
            $container->setDefinition(\Sau\WP\Framework\Bundle\ThemeBundle\Configuration::class,
                $configurationDefinition);
            $container->setAlias('theme.configuration', \Sau\WP\Framework\Bundle\ThemeBundle\Configuration::class)
                      ->setPublic(true);
        }


    }

}
