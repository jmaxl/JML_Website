<?php

namespace Project;

require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/config.php';

use Project\View\ViewRenderer;

$template = 'default/page.twig';

$variables = ['variable' => 'Dies ist eine Testseite'];

$renderer = new ViewRenderer();
$renderer->renderTemplate($template, $variables);