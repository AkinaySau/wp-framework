<?php
/**
 * Created by PhpStorm.
 * User: AkinaySau(akinaysau@gmail.com)
 * Date: 19.12.18
 * Time: 16:49
 *
 * @package wp-framework
 */

namespace Sau\WP\Framework\Bundle\ThemeBundle\Registration;


use Sau\WP\Framework\Bundle\ThemeBundle\Configuration;

interface RegistrationInterface
{
    public function registration(Configuration $cofiguration);
}
