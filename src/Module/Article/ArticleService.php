<?php
declare (strict_types=1);

namespace JML\Module\Article;

use JML\Module\Author\AuthorService;
use JML\Module\Database\Database;
use JML\Module\GenericValueObject\Datetime;
use JML\Module\GenericValueObject\Id;
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

    public function getArticleByParams(array $params, Id $userId = null): ?Article
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
        if ($this->articleFactory->isObjectValid($object) === false){
            return null;
        }
        return $this->articleFactory->getArticle($object);
    }

    public function safeArticleToDatabase(Article $article): bool
    {
        return $this->articleRepository->safeArticleToDatabase($article);
    }
}