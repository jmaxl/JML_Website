<?php
declare(strict_types=1);

namespace Project\Controller;


class IndexController extends DefaultController
{
    public function indexAction(): void
    {
        $pageTemplate = 'index.twig';
        $config = ['page' => 'home'];

        $this->viewRenderer->renderTemplate($pageTemplate, $config);
    }
}