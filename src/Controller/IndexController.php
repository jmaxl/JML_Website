<?php
declare(strict_types=1);

namespace JML\Controller;

use JML\Module\User\UserService;

class IndexController extends DefaultController
{
    public function indexAction(): void
    {
        $mail = 'peter@peter.de';
        $password = 'peter';
        $userService = new UserService();
        $user = $userService->getLoggedInUserByMail($mail, $password);
        var_dump($user);

    }

    public function impressumAction(): void
    {
        $this->showStandardPage('impressum');
    }

    public function differentIndexAction(): void
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