<?php
/**
 * Created by PhpStorm.
 * User: AkinaySau(akinaysau@gmail.com)
 * Date: 18.12.18
 * Time: 14:40
 *
 * @package wp-framework
 */

namespace Sau\WP\Framework\Bundle\CarbonBundle\Carbon;


interface ContainerInterface
{
    const THEME_OPTIONS = 'theme_options';
    const TERM_META     = 'term_meta';
    const USER_META     = 'user_meta';
    const COMMENT_META  = 'comment_meta';
    const NAV_MENU_ITEM = 'nav_menu_item';
    const POST_META     = 'post_meta';

    /**
     * @return string Machine name block
     */
    public function getType(): string;

    /**
     * @return string Title
     */
    public function getTitle(): string;

    /**
     * @return void
     */
    public function init();
}
