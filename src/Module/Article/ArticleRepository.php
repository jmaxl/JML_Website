<?php
declare (strict_types=1);

namespace JML\Module\Article;

use JML\Module\Database\Database;
use JML\Module\GenericValueObject\Id;

/**
 * Class ArticleRepository
 * @package JML\Module\Article
 */
class ArticleRepository
{
    const TABLE = 'article';
    const TABLE_ARTICLE_AUTHOR = 'article_author';

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

    /**
     * @param Id $articleId
     * @return array
     */
    public function getAllAuthorIdsByArticleId(Id $articleId): array
    {
        $query = $this->database->getNewSelectQuery(self::TABLE_ARTICLE_AUTHOR);
        $query->where('articleId', '=', $articleId->toString());
        $query->addEntityToType('authorId');

        return $this->database->fetchAll($query);
    }

    public function safeArticleToDatabase(Article $article): bool
    {
        $query = $this->database->getNewInsertQuery(self::TABLE);
        $query->insert('articleId', $article->getArticleId()->toString());
        $query->insert('title', $article->getTitle()->getTitle());
        $query->insert('text', $article->getText()->getText());
        $query->insert('subtitle', $article->getSubtitle()->getTitle());
        $query->insert('userId', $article->getUserId()->toString());
        $query->insert('created', $article->getCreated()->toString());

        return $this->database->execute($query);
    }

}