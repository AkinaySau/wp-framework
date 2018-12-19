<?php
/**
 * Created by PhpStorm.
 * User: AkinaySau(akinaysau@gmail.com)
 * Date: 18.12.18
 * Time: 16:15
 *
 * @package wp-framework
 */

namespace Sau\WP\Framework\Bundle\AdminBundle\Admin;


use Symfony\Component\DependencyInjection\ContainerInterface;

abstract class AbstractAdmin implements AdminInterface
{

    /**
     * @var string
     */
    protected $capability = 'manage_options';
    /**
     * Size 20*20
     * @var string
     */
    protected $icon_url = '';
    /**
     * @var int
     */
    protected $position = 99;
    /**
     * @var ContainerInterface
     */
    private $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
        add_action('admin_menu', function () {
            add_menu_page($this->getPageTitle(), $this->getMenuTitle(), $this->capability, $this->getMenuSlug(),
                [$this, 'render'], $this->icon_url, $this->position);
        });
    }

    protected function getMenuTitle(): string
    {
        return $this->getPageTitle();
    }

    abstract public function render();

    public function __toString()
    {
        return get_class($this);
    }

    /**
     * @return ContainerInterface
     */
    protected function getContainer(): ContainerInterface
    {
        return $this->container;
    }
}
