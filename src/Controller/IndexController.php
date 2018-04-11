<?php
declare (strict_types=1);

namespace JML\Controller;

use JML\Module\Article\ArticleService;
use JML\Module\GenericValueObject\Mail;
use JML\Module\User\UserService;
use JML\Utilities\Tools;

/**
 * Class IndexController
 * @package JML\Controller
 */
class IndexController extends DefaultController
{
    /**
     * main action for the index page
     */
    public function indexAction(): void
    {
        $articleService = new ArticleService($this->database);
        $articles = $articleService->getAllArticleOrderByDate();

        $this->viewRenderer->addViewConfig('articles', $articles);
        $this->viewRenderer->addViewConfig('page', 'home');
        $this->viewRenderer->renderTemplate();
    }

    /**
     * action for impressum site
     */
    public function impressumAction(): void
    {
        $this->showStandardPage('impressum');
    }

    public function logInAction(): void
    {
        $this->showStandardPage('logIn');
    }

    public function logInRedirectAction(): void
    {
        $mail = Mail::fromString(Tools::getValue('mail'));
        //$password = Password::fromString(Tools::getValue('password'));
        $password = Tools::getValue('password');

        $userService = new UserService($this->database);
        $user = $userService->getLoggedInUserByMail($mail, $password);
        if ($user === null){
            header('Location: ' . Tools::getRouteUrl('logIn'));
        } else{
            header('Location: ' . Tools::getRouteUrl('backend'));
        }
    }
}