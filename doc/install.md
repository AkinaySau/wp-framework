# Install
Framework mady install in plugin or template

First install pack:
```
composer require sau/wp-framework
``` 
 
## Plugin
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

## Theme
