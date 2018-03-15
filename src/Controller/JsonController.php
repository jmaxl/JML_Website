<?php
declare (strict_types=1);

namespace JML\Controller;

use JML\Configuration;

use JML\Module\Article\ArticleService;
use JML\Module\Author\AuthorService;
use JML\Module\GenericValueObject\Id;
use JML\Utilities\Tools;
use JML\View\JsonModel;

/**
 * Class BackendController
 * @package Project\Controller
 */
class JsonController extends DefaultController
{
    /** @var JsonModel $jsonModel */
    protected $jsonModel;

    /**
     * JsonController constructor.
     *
     * @param Configuration $configuration
     */
    public function __construct(Configuration $configuration)
    {
        parent::__construct($configuration);

        $this->jsonModel = new JsonModel();
    }

    public function editArticleAction()
    {
        $articleService = new ArticleService($this->database);
        $article = $articleService->getFullArticleById(Id::fromString(Tools::getValue('articleId')));
        $this->viewRenderer->addViewConfig('article', $article);

        $authorService = new AuthorService($this->database);
        $authorList = $authorService->getAuthorList();
        $this->viewRenderer->addViewConfig('authorList', $authorList);

        $this->jsonModel->addJsonConfig('view', $this->viewRenderer->renderJsonView('partial/editArticle.twig'));
        $this->jsonModel->send();
    }
}