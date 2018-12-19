<?php
/**
 * Created by PhpStorm.
 * User: AkinaySau(akinaysau@gmail.com)
 * Date: 19.12.18
 * Time: 16:35
 *
 * @package wp-framework
 */

namespace Sau\WP\Framework\Bundle\ThemeBundle\Registration;


use Sau\WP\Framework\Bundle\ThemeBundle\Configuration;

class MenuRegistration implements RegistrationInterface
{
    /**
     * @param Configuration $configuration
     */
    public function registration(Configuration $configuration)
    {
        if (is_array($menu = $configuration->getConfig('menu'))) {
            $items = [];
            foreach ($menu as $i) {
                $items[ $i[ 'slug' ] ] = $i[ 'title' ];
            }
            register_nav_menus($items);
        }
    }
}
