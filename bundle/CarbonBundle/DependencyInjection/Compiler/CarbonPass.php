<?php
/**
 * Created by PhpStorm.
 * User: AkinaySau(akinaysau@gmail.com)
 * Date: 18.12.18
 * Time: 11:56
 *
 * @package wp-framework
 */

namespace Sau\WP\Framework\Bundle\CarbonBundle\DependencyInjection\Compiler;


use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\Compiler\PriorityTaggedServiceTrait;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class CarbonPass implements CompilerPassInterface
{
    use PriorityTaggedServiceTrait;

    /**
     * You can modify the container here before it is dumped to PHP code.
     */
    public function process(ContainerBuilder $container)
    {
        if ( ! $container->has('carbon.container_loader')) {
            return;
        }
        $definition     = $container->findDefinition('carbon.container_loader');
        $taggedServices = $container->findTaggedServiceIds('carbon.container');
        foreach ($taggedServices as $id => $tags) {
            $definition->addMethodCall('add', [new Reference($id)]);
        }
    }
}
