<?php
declare (strict_types=1);


namespace JML\Module\Article;

use JML\Module\Database\Database;

class ArticleRepository
{
    const TABLE = 'article';
    protected $database;

    public function __construct(Database $database)
    {
        $this->database = $database;
    }


    public function getAllArticleByDate(): array
    {
        $query = $this->database->getNewSelectQuery(self::TABLE;
        $query->orderBy('created', 'DESC');
        return $this->database->fetchAll($query);
    }
}