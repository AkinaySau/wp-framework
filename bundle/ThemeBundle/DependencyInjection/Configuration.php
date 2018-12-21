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
                     ->arrayNode('thumbnail')
                         ->arrayPrototype()
                             ->children()
                                 ->scalarNode('name')
                                    ->isRequired()
                                    ->validate()
                                        ->ifTrue(function ($var){return !is_string($var);})
                                        ->thenInvalid('"name" is not string')
                                    ->end()
                                 ->end()
                                 ->integerNode('width')->isRequired()->end()
                                 ->integerNode('height')->isRequired()->end()
                                 ->variableNode('crop')
                                    ->defaultValue(false)
                                    ->validate()
                                        ->ifTrue(function ($val){
                                            if (is_bool($val)){
                                                return false;
                                            }
                                            if (is_array($val) && array_key_exists(['x','y'],$val)){
                                                return false;
                                            }
                                            return true;
                                        })
                                        ->thenInvalid('"crops" maybe only bool or array([x=100, y=100])')
                                    ->end()
                                 ->end()
                                 ->scalarNode('media_manager')
                                    ->defaultFalse()
                                    ->validate()
                                        ->ifTrue(function ($var){return !is_string($var);})
                                        ->thenInvalid('"media_manager" is not string')
                                    ->end()
                                 ->end()
                             ->end()
                         ->end()
                     ->end();
    }
}
