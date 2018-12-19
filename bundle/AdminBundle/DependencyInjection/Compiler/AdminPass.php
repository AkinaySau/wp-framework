<?php
/**
 * Created by PhpStorm.
 * User: AkinaySau(akinaysau@gmail.com)
 * Date: 18.12.18
 * Time: 16:11
 *
 * @package wp-framework
 */

namespace Sau\WP\Framework\Bundle\AdminBundle\DependencyInjection\Compiler;


use Sau\WP\Framework\Bundle\AdminBundle\Admin\CollectionAdmin;
use Sau\WP\Framework\Bundle\CarbonBundle\Carbon\ContainerChain;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class AdminPass implements CompilerPassInterface
{

    /**
     * You can modify the container here before it is dumped to PHP code.
     */
    public function process(ContainerBuilder $container)
    {
        if ( ! $container->has(CollectionAdmin::class)) {
            return;
        }

        $definition = $container->findDefinition(CollectionAdmin::class);

        $taggedServices = $container->findTaggedServiceIds('admin.page');

        foreach ($taggedServices as $id => $tags) {
            $definition->addMethodCall('addAdminPage', array(new Reference($id)));
        }
    }
}
