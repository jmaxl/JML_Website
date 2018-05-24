<?php
declare (strict_types=1);

namespace JML\Controller;

use JML\Module\Article\ArticleService;
use JML\Module\GenericValueObject\Id;
use JML\Module\GenericValueObject\Mail;
use JML\Module\Tag\TagService;
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
        $tagService = new TagService($this->database);
        var_dump($tagService->getTagByTagId(Id::fromString('3c12088c-1a28-4857-ba54-630235c1831b')));

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

    public function contactAction(): void
    {
        $this->showStandardPage('contact');
    }

    public function articleAction(): void
    {
        $articleId = Id::fromString(Tools::getValue('articleId'));
        $articleService = new ArticleService($this->database);
        $article = $articleService->getArticleById($articleId);

        $this->viewRenderer->addViewConfig('article', $article);
        $this->viewRenderer->addViewConfig('page', 'article');
        $this->viewRenderer->renderTemplate();
    }
}