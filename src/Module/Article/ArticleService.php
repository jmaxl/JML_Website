<?php
declare (strict_types=1);

namespace JML\Module\Article;

use JML\Module\Database\Database;

/**
 * Class ArticleService
 * @package JML\Module\Article
 */
class ArticleService
{
    /** @var ArticleRepository */
    protected $articleRepository;

    /** @var ArticleFactory */
    protected $articleFactory;

    /**
     * ArticleService constructor.
     * @param Database $database
     */
    public function __construct(Database $database)
    {
        $this->articleRepository = new ArticleRepository($database);
        $this->articleFactory = new ArticleFactory();
    }

    /**
     * @return array
     */
    public function getAllArticleOrderByDate(): array
    {
        $articles = [];
        $result = $this->articleRepository->getAllArticleByDate();
        foreach ($result as $article) {
            $articles[] = $this->articleFactory->getArticle($article);
        }

        return $articles;
    }
}