<?php
/**
 * Created by PhpStorm.
 * User: AkinaySau(akinaysau@gmail.com)
 * Date: 18.12.18
 * Time: 16:19
 *
 * @package wp-framework
 */

namespace Sau\WP\Framework\Bundle\AdminBundle\Admin;

interface AdminInterface
{
    public function getPageTitle():string ;
    public function getMenuSlug():string ;
}
