<?php
declare (strict_types=1);


namespace JML\Module\Article;

use JML\Module\Database\Database;

class ArticleService
{

    protected $articleRepository;
    protected $articleFactory;

    public function __construct(Database $database)
    {
        $this->articleRespository = new ArticleRepository($database);
        $this->articleFactory = new ArticleFactory();
    }

    public function getAllArticleOrderByDate(): array
    {
     $result = $this->articleRepository->getAllArticleByDate();
     return  $this->articleFactory->getAllArticle($result);
    }

}