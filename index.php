<?php
declare (strict_types=1);

namespace JML;

use JML\Controller\IndexController;
use JML\Module\GenericValueObject\Id;
use JML\Utilities\Tools;

session_start();

define('ROOT_PATH', getcwd());

require ROOT_PATH . '/vendor/autoload.php';

$route = 'index';

if (Tools::getValue('route') !== false) {
    $route = Tools::getValue('route') ;
}

$routing = new Routing(new Configuration());

try {
    $routing->startRoute($route);
} catch(\InvalidArgumentException $error) {
    $indexController = new IndexController(new Configuration());
    $indexController->errorPageAction();
}