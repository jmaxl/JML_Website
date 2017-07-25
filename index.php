<?php

namespace Project;

define('ROOT_PATH', getcwd());

require ROOT_PATH . '/vendor/autoload.php';

use Project\Module\Database\Database;
use Project\View\ViewRenderer;

$configuration = new Configuration();
$renderer = new ViewRenderer($configuration);
$database = Database::getInstance();

$template = 'index.twig';

$variables = ['variable' => ''];

$renderer->renderTemplate($template, $variables);