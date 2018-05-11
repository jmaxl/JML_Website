<?php
declare (strict_types=1);

namespace JML\Module\Article;

use JML\Module\Author\AuthorService;
use JML\Module\Database\Database;
use JML\Module\GenericValueObject\Datetime;
use JML\Module\GenericValueObject\Id;
use JML\Module\Picture\Picture;
use JML\Module\Picture\PictureService;

/**
 * Class ArticleService
 * @package JML\Module\Article
 */
class ArticleService
{
    /** @var ArticleRepository $articleRepository */
    protected $articleRepository;

    /** @var ArticleFactory $articleFactory */
    protected $articleFactory;

    /** @var AuthorService $authorService */
    protected $authorService;

    protected $pictureService;

    /**
     * ArticleService constructor.
     * @param Database $database
     */
    public function __construct(Database $database)
    {
        $this->articleRepository = new ArticleRepository($database);
        $this->articleFactory = new ArticleFactory();
        $this->authorService = new AuthorService($database);
        $this->pictureService = new PictureService($database);
    }

    /**
     * @return array
     */
    public function getAllArticleOrderByDate(): array
    {
        $articles = [];
        $result = $this->articleRepository->getAllArticleByDate();

        foreach ($result as $articleEntry) {
            $article = $this->articleFactory->getArticle($articleEntry);
            $authorIds = $this->articleRepository->getAllAuthorIdsByArticleId($article->getArticleId());

            foreach ($authorIds as $authorId) {
                $authorId = Id::fromString($authorId->authorId);
                $author = $this->authorService->getAuthorByAuthorId($authorId);
                $article->addAuthorToAuthorList($author);
            }
            $pictures = $this->pictureService->getAllPicturesByArticleId($article->getArticleId());

            foreach ($pictures as $picture) {
                $article->addPictureToPictureList($picture);
            }

            $articles[] = $article;
        }
        return $articles;
    }

    public function getArticleByParams(array $params, Id $userId = null, Picture $picture = null): ?Article
    {
        $object = (object)$params;

        if (empty($object->articleId)) {
            $object->articleId = Id::generateId()->toString();
        }
        if (empty($object->created)) {
            $object->created = Datetime::fromValue("now")->toString();
        }
        if (empty($object->userId)) {
            if ($userId === null) {
                return null;
            }
            $object->userId = $userId->toString();
        }
        if ($this->articleFactory->isObjectValid($object) === false) {
            return null;
        }
        $article = $this->articleFactory->getArticle($object);
        if ($article === null) {
            return null;
        }
        foreach ($object->author as $authorData) {
            $author = $this->authorService->getAuthorByAuthorId(Id::fromString($authorData));
            $article->addAuthorToAuthorList($author);
        }
        if ($picture !== null){
            $article->addPictureToPictureList($picture);
        }

        return $article;
    }

    public function safeArticleToDatabase(Article $article): bool
    {
        if ($this->articleRepository->safeArticleToDatabase($article) === false) {
            return false;
        }
        $this->articleRepository->deleteAuthorArticleInDatabase($article);
        $authorList = $article->getAuthorList();
        foreach ($authorList as $author) {
            if ($this->articleRepository->safeAuthorToAuthorArticleTable($author, $article->getArticleId()) === false) {
                throw new \Exception('Da ist etwas schief gegangen!');
            }
        }
        $pictureList = $article->getPictureList();
        foreach ($pictureList as $picture){
            if($this->pictureService->savePictureToDatabase($picture) === true){
                if($this->articleRepository->savePictureToPictureArticleTable($picture, $article->getArticleId()) === false) {
                    throw new \Exception('Da ist etwas schief gegangen!');
                }
            }
        }

        return true;
    }

    public function getArticleById(Id $articleId): Article
    {
        $article = $this->articleRepository->getArticleById($articleId);
        return $this->articleFactory->getArticle($article);
    }

    public function deleteArticleInDatabase(Article $article): bool
    {
        if ($this->articleRepository->deleteArticleInDatabase($article) === true) {
            return $this->articleRepository->deleteAuthorArticleInDatabase($article);
        }
        return false;
    }

    public function getFullArticleById(Id $articleId): ?Article
    {
        $article = $this->getArticleById($articleId);
        $authorIds = $this->articleRepository->getAllAuthorIdsByArticleId($article->getArticleId());

        foreach ($authorIds as $authorId) {
            $authorId = Id::fromString($authorId->authorId);
            $author = $this->authorService->getAuthorByAuthorId($authorId);
            $article->addAuthorToAuthorList($author);
        }
        $pictures = $this->pictureService->getAllPicturesByArticleId($article->getArticleId());

        foreach ($pictures as $picture) {
            $article->addPictureToPictureList($picture);
        }
        return $article;
    }
}