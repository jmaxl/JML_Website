<?php

namespace Project;

define('ROOT_PATH', getcwd());

require ROOT_PATH . '/vendor/autoload.php';

/*use Project\Module\Database\Database;
use Project\View\ViewRenderer;

$configuration = new Configuration();
$renderer = new ViewRenderer($configuration);
$database = Database::getInstance();

$template = 'index.twig';

$variables = ['page' => 'home'];

$renderer->renderTemplate($template, $variables);*/


$route = 'index';

if (isset($_GET['route'])) {
    $route = $_GET['route'];
}

$routing = new Routing(new Configuration());
$routing->startRoute($route);