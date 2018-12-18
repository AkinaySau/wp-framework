<?php
/**
 * Created by PhpStorm.
 * User: AkinaySau(akinaysau@gmail.com)
 * Date: 18.12.18
 * Time: 16:14
 *
 * @package wp-framework
 */

namespace Sau\WP\Framework\Bundle\AdminBundle\Admin;


class CollectionAdmin
{
    protected $collection;

    public function addAdminPage(AbstractAdmin $admin)
    {
        $this->collection[ get_class($admin) ] = $admin;
    }

    public function getContainer($class): AbstractAdmin
    {
        if (array_key_exists($class, $this->collection)) {
            return $this->collection[ $class ];
        }
    }
}
