<?php
/**
 * Created by PhpStorm.
 * User: AkinaySau(akinaysau@gmail.com)
 * Date: 19.12.18
 * Time: 12:30
 *
 * @package wp-framework
 */

namespace Sau\WP\Framework\Bundle\ThemeBundle\DependencyInjection;


use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{

    /**
     * Generates the configuration tree builder.
     *
     * @return TreeBuilder The tree builder
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder('theme');
        $rootNode    = $treeBuilder->getRootNode();

        $this->addMenuSection($rootNode);
        $this->addThumbnailSection($rootNode);

        return $treeBuilder;
    }

    private function addMenuSection(ArrayNodeDefinition $rootNode)
    {
        $rootNode->children()
                    ->arrayNode('menu')
                        ->arrayPrototype()
                            ->children()
                                ->scalarNode('slug')->end()
                                ->scalarNode('title')->end()
                            ->end()
                        ->end()
                    ->end();
    }

    private function addThumbnailSection(ArrayNodeDefinition $rootNode)
    {
        $rootNode->children()
                     ->arrayNode('menu')
                         ->arrayPrototype()
                             ->children()
                                 ->scalarNode('name')->isRequired()->end()
                                 ->integerNode('width')->isRequired()->end()
                                 ->integerNode('height')->isRequired()->end()
                                 ->booleanNode('crop')->end()
                                 ->scalarNode('media_manager')->validate()->end()
                             ->end()
                         ->end()
                     ->end();
//        $name, $width, $height, $crop = false, $media_manager = false
    }
}
