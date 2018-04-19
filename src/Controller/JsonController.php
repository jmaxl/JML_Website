<?php
declare (strict_types=1);

namespace JML\Controller;

use JML\Configuration;

use JML\Module\Article\ArticleService;
use JML\Module\Author\AuthorService;
use JML\Module\GenericValueObject\Id;
use JML\Module\Picture\PictureService;
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

        $pictureService = new PictureService($this->database);
        $pictureList = $pictureService->getAllPicturesByArticleId(Id::fromString(Tools::getValue('articleId')));
        $this->viewRenderer->addViewConfig('pictureList', $pictureList);

        $this->jsonModel->addJsonConfig('view', $this->viewRenderer->renderJsonView('partial/editArticle.twig'));
        $this->jsonModel->send();
    }

    public function createAuthorAction()
    {
        $authorService = new AuthorService($this->database);
        $author = $authorService->getAuthorByParams($_POST);
        if ($author !== null) {
            if ($authorService->saveAuthorToDatabase($author) === true) {
                $this->jsonModel->addJsonConfig('author', $author);
                $this->jsonModel->send();
            }
        }
        $this->jsonModel->send('error');
    }

    public function deletePictureAction()
    {
        $pictureService = new PictureService($this->database);
        $picture = $pictureService->getPictureById(Id::fromString(Tools::getValue('pictureId')));

        $pictureService->deletePictureInArticlePictureDatabase($picture);

        $this->jsonModel->addJsonConfig('view', $this->viewRenderer->renderJsonView('partial/editArticle.twig'));
        $this->jsonModel->send();
    }
}