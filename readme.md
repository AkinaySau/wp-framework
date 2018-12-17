# WP framework
Small framework for dev plugin or templates in WP

In base use Symfony framework(bundle):
 
## Install
Framework mady install in plugin or template

First install pack:
```
composer require sau/wp-framework
``` 
 
### Plugin install
Add this code in base file framework
```php
use Sau\WP\Framework\Install\Install;
use Sau\WP\Framework\Install\Remove;

include_once __DIR__.'/vendor/autoload.php';

register_activation_hook (__FILE__, function(){
    Install::install(__DIR__);
});
register_deactivation_hook (__FILE__, function(){
    Remove::deactivate(__DIR__);
});
```

### Theme install
Add this code in function.php file framework
```php
use Sau\WP\Framework\Install\Install;
use Sau\WP\Framework\Install\Remove;

include_once __DIR__.'/vendor/autoload.php';

add_action('after_switch_theme', function(){
    Install::install(__DIR__);
});
add_action('switch_theme', function(){
    Remove::deactivate(__DIR__);
});
```

### After Install
After install with activate plugin/theme. In project you see infrastructure

Start codding...


## Extend
Base extend it's [Bundle](https://symfony.com/doc/current/bundles.html)

If using base infrastructure use as symfony flex application

### Action
If need extent plugin in theme, isset action 
```php
use Sau\WP\Framework\Kernel\Kernel;

//___name___ its name plugin/template  
add_action("___name___",function(Kernel $kernel){
    #...your code
})
```

## Use in wp template
If you need use kernel in your code: 
```php
global $sau_kernels;
//___name___ its name plugin/template 
$sau_kernels[ '___name___' ]->getContainer()
                           ->get('twig')
                           ->display('index.html.twig');
```
