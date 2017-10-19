<?php
declare (strict_types=1);


namespace JML\Module\Article;

use JML\Module\Database\Database;

class ArticleService
{
    /** @var ArticleRepository  */
    protected $articleRepository;

    /** @var ArticleFactory  */
    protected $articleFactory;

    public function __construct(Database $database)
    {
        $this->articleRespository = new ArticleRepository($database);
        $this->articleFactory = new ArticleFactory();
    }

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