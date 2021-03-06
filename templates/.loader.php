<?php
/**
 * Created by PhpStorm.
 * User: AkinaySau(akinaysau@gmail.com)
 * Date: 15.12.18
 * Time: 12:24
 *
 * @package wp-framework
 */

use Sau\WP\Framework\Event\LoadEvent;
use Sau\WP\Framework\Event\RegisterActionsEvent;
use Sau\WP\Framework\Kernel\Kernel;
use Symfony\Component\Debug\Debug;
use Symfony\Component\Dotenv\Dotenv;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

#start loader

require_once __DIR__.'/vendor/autoload.php';
require_once __DIR__.'/.defines.php';

###Create env###
$path_to_env = ABSPATH.'.env';
if ( ! file_exists($path_to_env)) {
    $path_to_env = __DIR__.'/.env';
}
if ( ! class_exists(Dotenv::class)) {
    throw new \RuntimeException('APP_ENV environment variable is not defined. You need to define environment variables for configuration or add "symfony/dotenv" as a Composer dependency to load variables from a .env file.');
}
if ( ! file_exists($path_to_env)) {
    throw new \RuntimeException('Env file not found');
}
(new Dotenv())->load($path_to_env);
###end load env###

$env   = $_SERVER[ 'APP_ENV' ] ?? 'dev';
$debug = (bool)($_SERVER[ 'APP_DEBUG' ] ?? ('prod' !== $env));

#Start in kernel##################
if ($debug) {
    umask(0000);

    //    $whoops = new \Whoops\Run;
    //    $whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
    //    $whoops->register();

    Debug::enable();
}
##################################
#use antonym class for get right path to project
$kernel  = new class($env, $debug) extends Kernel
{
};
$request = Request::createFromGlobals();

###or add your name for constant kernel
$name = strtolower(basename(__DIR__).'_kernel');
$name = preg_replace("/[^a-zA-Z0-9_]/", "", $name);
global $sau_kernels;
if ( ! is_array($sau_kernels)) {
    $sau_kernels = [$name => $kernel];
} else {
    $sau_kernels[ $name ] = $kernel;
}
###

add_action('after_setup_theme', function () use ($kernel, $request, $name) {
    /**
     * Before kernel is boot
     */
    do_action('before_boot_'.$name, $kernel);

    $response = $kernel->handle($request);

    //for fast load actions
    if ($kernel->getContainer()
               ->has('event_dispatcher')) {
        $kernel->getContainer()
               ->get('event_dispatcher')
               ->dispatch(RegisterActionsEvent::NAME, new RegisterActionsEvent());
    }

    /**
     * After kernel is boot
     */
    do_action('after_boot_'.$name, $kernel);
    /**
     * For modify response
     */
    do_action('response_'.$name, $response);

    #find controller and response
    if ($response instanceof Response && ! $response->isNotFound()) {
        $response->send();
        $kernel->terminate($request, $response);
    } else {
        ob_start();
        add_action('shutdown', function () use ($kernel, $request) {
            $content = ob_get_contents();
            ob_end_clean();
            $response = new Response();
            $response->setContent($content);
            $response->send();
            $kernel->terminate($request, $response);
        }, 0, 99);
    }
    //    }

}, 0, 0);

#end loader


