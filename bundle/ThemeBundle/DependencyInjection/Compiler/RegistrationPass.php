<?php
/**
 * Created by PhpStorm.
 * User: AkinaySau(akinaysau@gmail.com)
 * Date: 19.12.18
 * Time: 17:11
 *
 * @package wp-framework
 */

namespace Sau\WP\Framework\Bundle\ThemeBundle\DependencyInjection\Compiler;


use Sau\WP\Framework\Bundle\ThemeBundle\Loader\RegistrationLoader;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class RegistrationPass implements CompilerPassInterface
{

    /**
     * You can modify the container here before it is dumped to PHP code.
     */
    public function process(ContainerBuilder $container)
    {
        if ( ! $container->has(RegistrationLoader::class)) {
            return;
        }
        $definition = $container->findDefinition(RegistrationLoader::class);

        $taggedServices = $container->findTaggedServiceIds('theme.registration_services');


        foreach ($taggedServices as $id => $tags) {
            $definition->addMethodCall('add', [new Reference($id)]);
        }
    }
}
