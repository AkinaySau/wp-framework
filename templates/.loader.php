<?php
/**
 * Created by PhpStorm.
 * User: AkinaySau(akinaysau@gmail.com)
 * Date: 15.12.18
 * Time: 12:24
 *
 * @package wp-framework
 */

use Sau\WP\Framework\Kernel\Kernel;
use Symfony\Component\Dotenv\Dotenv;

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

$env = $_SERVER['APP_ENV'] ?? 'dev';
$debug = (bool) ($_SERVER['APP_DEBUG'] ?? ('prod' !== $env));

if ($debug) {
    umask(0000);

    $whoops = new \Whoops\Run;
    $whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
    $whoops->register();
//    Debug::enable();
}

#use antonym class for get right path to project
$kernel = new class($env,$debug) extends Kernel{};


#end loader
