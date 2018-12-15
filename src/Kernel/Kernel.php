<?php
/**
 * Created by PhpStorm.
 * User: AkinaySau(akinaysau@gmail.com)
 * Date: 15.12.18
 * Time: 13:50
 *
 * @package wp-framework
 */

namespace Sau\WP\Framework\Kernel;


use Sau\WP\Framework\Bundle\Bundle;
use Sau\WP\Framework\Exception\BaseException;

/**
 * Class Kernel
 *          1) start on .loader.php(mu_plugin)
 *          2) boot base package
 *          3) collect services (add_acton("init"))
 *          4) build container in add_acton("init",*,*,99), and search route
 *              if exist run controller->response
 *              else =>
 *          5) work wp
 * @package Sau\WP\Framework\Kernel
 */
class Kernel
{

    private   $container;
    private   $projectDir;
    protected $environment;
    protected $debug;

    /**
     * Kernel constructor.
     * @throws BaseException
     */
    public function __construct(string $env, bool $debug)
    {
        $this->environment = $env;
        $this->debug       = $debug;

        $this->boot();
    }

    private function boot()
    {

        add_action('init', function () {
            $this->bootInit();
        });
    }

    /**
     * @throws BaseException
     */
    private function bootInit()
    {

        $packs = apply_filters('sf_add_packages', []);
        if ( ! is_array($packs)) {
            throw new BaseException(sprintf('Invalid pack collection need array, return %s', gettype($packs)));
        }


        foreach ($packs as $key => $pack) {
            if (class_exists($key) && $class = new $key instanceof Bundle) {

            }
        }


    }

    /**
     * @return mixed
     */
    public function getContainer()
    {
        return $this->container;
    }


    /**
     * Gets the application root dir (path of the project's composer file).
     *
     * @return string The project root dir
     */
    public function getProjectDir()
    {
        if (null === $this->projectDir) {
            $r   = new \ReflectionObject($this);
            $dir = $rootDir = \dirname($r->getFileName());
            while ( ! file_exists($dir.'/composer.json')) {
                if ($dir === \dirname($dir)) {
                    return $this->projectDir = $rootDir;
                }
                $dir = \dirname($dir);
            }
            $this->projectDir = $dir;
        }

        return $this->projectDir;
    }

    /**
     * @return string
     */
    public function getEnvironment(): string
    {
        return $this->environment;
    }

    /**
     * @return bool
     */
    public function isDebug(): bool
    {
        return $this->debug;
    }


}
