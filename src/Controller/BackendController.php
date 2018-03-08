<?php
declare (strict_types=1);


namespace JML\Controller;

use JML\Configuration;
use JML\Module\Article\ArticleService;
use JML\Module\Author\AuthorService;
use JML\Module\GenericValueObject\Id;
use JML\Routing;
use JML\Utilities\Tools;

class BackendController extends DefaultController
{
    public function __construct(Configuration $configuration)
    {
        parent::__construct($configuration);
        if ($this->loggedInUser === null){
            $this->showStandardPage(Routing::ERROR_ROUTE);
            exit;
        }

    }

    public function backendAction(): void
    {
        $articleService = new ArticleService($this->database);
        $articles = $articleService->getAllArticleOrderByDate();

        $authorService = new AuthorService($this->database);
        $authorList = $authorService->getAuthorList();

        $this->viewRenderer->addViewConfig('articles', $articles);
        $this->viewRenderer->addViewConfig('authorList', $authorList);
        $this->viewRenderer->addViewConfig('page', 'backend');
        $this->viewRenderer->renderTemplate();
    }

    public function createArticleAction():  void
    {
        $articleService = new ArticleService($this->database);
        $article = $articleService->getArticleByParams($_POST, $this->loggedInUser->getUserId());
        if($article === null){
            header('Location: ' . Tools::getRouteUrl('backend'));
            exit;
        }
        $articleService->safeArticleToDatabase($article);
        header('Location: ' . Tools::getRouteUrl('backend'));
    }

    public function deleteArticleAction()
    {
        $articleService = new ArticleService($this->database);
        $article = $articleService->getArticleById(Id::fromString(Tools::getValue('articleId')));

        $articleService->deleteArticleInDatabase($article);
        header('Location: ' . Tools::getRouteUrl('backend'));
    }

    public function deleteAuthorAction()
    {
        $authorService = new AuthorService(($this->database));
        $author = $authorService->getAuthorByAuthorId(Id::fromString(Tools::getValue('authorId')));

        $authorService->deleteAuthorInDatabase($author);
        header('Location: ' . Tools::getRouteUrl('backend'));
    }

}