<?php
declare (strict_types=1);

namespace JML\Module\Article;

use JML\Module\Database\Database;

/**
 * Class ArticleRepository
 * @package JML\Module\Article
 */
class ArticleRepository
{
    const TABLE = 'article';

    /** @var Database $database */
    protected $database;

    /**
     * ArticleRepository constructor.
     * @param Database $database
     */
    public function __construct(Database $database)
    {
        $this->database = $database;
    }

    /**
     * @return array
     */
    public function getAllArticleByDate(): array
    {
        $query = $this->database->getNewSelectQuery(self::TABLE);
        $query->orderBy('created', 'DESC');

        return $this->database->fetchAll($query);
    }
}