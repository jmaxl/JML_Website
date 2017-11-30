<?php
declare (strict_types=1);

namespace JML\Module\Article;

use JML\Module\Author\AuthorService;
use JML\Module\Database\Database;
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
            foreach ($authorIds as $authorId){
                $authorId = Id::fromString($authorId->authorId);
                $author = $this->authorService->getAuthorByAuthorId($authorId);
                $article->addAuthorToAuthorList($author);
            }
            $pictures = $this->pictureService->getAllPicturesByArticleId($article->getArticleId());
            foreach ($pictures as $picture){
                $article->addPictureToPictureList($picture);
            }

            $articles[] = $article;
        }
        return $articles;
    }




}