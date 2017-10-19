<?php
declare(strict_types=1);

namespace JML\Controller;

use JML\Module\Database\Database;
use JML\Module\GenericValueObject\Id;
use JML\Module\User\UserService;

class IndexController extends DefaultController
{
    public function indexAction(): void
    {
        $mail = 'peter@peter.de';
        $password = 'peter';
        $userService = new UserService($this->database);
        //$user = $userService->getLoggedInUserByMail($mail, $password);
        //$id = Id::fromString('b9e4103d-6d29-43d4-8a18-df83188c03b8');
        //$user = $userService->getUserById($id);
        //var_dump($user);

        var_dump($userService->saveUser());


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