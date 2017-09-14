<?php
declare(strict_types=1);

namespace Project\Controller;

class IndexController extends DefaultController
{
    public function indexAction(): void
    {
        $this->showStandardPage('home');
    }

    public function differentIndexAcion(): void
    {
        try {
            $this->viewRenderer->addViewConfig('slider', 'sliderVariable');
            $this->viewRenderer->addViewConfig('page', 'home');

            $this->viewRenderer->renderTemplate();
        } catch (\InvalidArgumentException $error) {
            $this->notFoundAction();
        }
    }
}