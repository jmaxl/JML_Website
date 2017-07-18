<?php

namespace Project;

define('ROOT_PATH', getcwd());

require ROOT_PATH . '/vendor/autoload.php';

use Project\Module\Database\Database;
use Project\View\ViewRenderer;

$configuration = new Configuration();
$renderer = new ViewRenderer($configuration);
$database = Database::getInstance();

$users = $database->fetchById('user', array('idName' => 'userId', 'idValue' => 12345267));

$template = 'page.twig';

$variables = ['variable' => 'Dies ist eine Testseite'];


$renderer->renderTemplate($template, $variables);

var_dump($users);