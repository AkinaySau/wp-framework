<?php
/**
 * Created by PhpStorm.
 * User: AkinaySau(akinaysau@gmail.com)
 * Date: 18.12.18
 * Time: 11:49
 *
 * @package wp-framework
 */

namespace Sau\WP\Framework\Bundle\CarbonBundle;

use Sau\WP\Framework\Bundle\CarbonBundle\DependencyInjection\Compiler\CarbonPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class CarbonBundle extends Bundle
{
    public function boot()
    {
        if ($this->container->has('carbon')) {
            $this->container->get('carbon');
        }
    }

    public function build(ContainerBuilder $container)
    {

        parent::build($container);

        $container->addCompilerPass(new CarbonPass());
    }
}
