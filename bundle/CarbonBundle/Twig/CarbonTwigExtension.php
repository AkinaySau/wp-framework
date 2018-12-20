<?php
/**
 * Created by PhpStorm.
 * User: sau
 * Date: 20.12.2018
 * Time: 22:24
 */

namespace Sau\WP\Framework\Bundle\CarbonBundle\Twig;


use Twig_Extension;
use Twig_SimpleFunction;

class CarbonTwigExtension extends Twig_Extension
{
    public function getFunctions()
    {
        return [
            new Twig_SimpleFunction('crb_term', 'carbon_get_term_meta'),
            new Twig_SimpleFunction('crb_post', 'carbon_get_post_meta'),
            new Twig_SimpleFunction('crb_com', 'carbon_get_comment_meta'),
            new Twig_SimpleFunction('crb_nav', 'carbon_get_nav_menu_item_meta'),
            new Twig_SimpleFunction('crb_user', 'carbon_get_user_meta'),
            new Twig_SimpleFunction('crb_the_post', 'carbon_get_the_post_meta'),
            new Twig_SimpleFunction('crb_theme', 'carbon_get_theme_option'),
        ];
    }
}
