<?php
/**
 * Created by PhpStorm.
 * User: AkinaySau(akinaysau@gmail.com)
 * Date: 19.12.18
 * Time: 11:52
 *
 * @package wp-framework
 */

namespace Sau\WP\Framework\Bundle\ThemeBundle\Event;


use Symfony\Component\EventDispatcher\Event;

class ActionEvent extends Event
{
    const NAME = 'register_actions';

    public function __construct()
    {
    }
}
