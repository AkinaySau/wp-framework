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
    public function build(ContainerBuilder $container)
    {
        //        add_action('after_setup_theme', function () {
        \Carbon_Fields\Carbon_Fields::boot();
        //        });
        parent::build($container);

        $container->addCompilerPass(new CarbonPass());
    }
}
