Quokka\Loader
=============

Example
-------

```php
use Quokka\Loader;

$autoloader = new Loader\Autoloader();
$autoloader->addNamespace('Quokka', 'libraries/Quokka');
$autoloader->addNamespace('Application\\Controller', 'application/controllers');
$autoloader->addNamespace('Zend_Db', 'libraries/Zend/Db');
$autoloader->addClass('TCPDF', 'libraries/TCPDF/tcpdf_include.php');
$autoloader->register();
```
