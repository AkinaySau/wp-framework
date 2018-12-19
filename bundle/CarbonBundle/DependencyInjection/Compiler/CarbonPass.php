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


use Sau\WP\Framework\Bundle\CarbonBundle\Carbon\ContainerChain;
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

        if ( ! $container->has(ContainerChain::class)) {
            return;
        }

        $definition = $container->findDefinition(ContainerChain::class);

        $taggedServices = $container->findTaggedServiceIds('carbon.register');

        foreach ($taggedServices as $id => $tags) {
            $definition->addMethodCall('addContainer', array(new Reference($id)));
        }
    }
}
