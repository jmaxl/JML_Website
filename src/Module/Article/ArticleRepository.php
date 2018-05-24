<?php
declare (strict_types=1);

namespace JML\Module\Article;

use JML\Module\Author\Author;
use JML\Module\Database\Database;
use JML\Module\Database\Query;
use JML\Module\GenericValueObject\Id;
use JML\Module\Picture\Picture;

/**
 * Class ArticleRepository
 * @package JML\Module\Article
 */
class ArticleRepository
{
    const TABLE = 'article';
    const TABLE_ARTICLE_AUTHOR = 'article_author';
    const TABLE_ARTICLE_PICTURE = 'article_picture';


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
        $query->orderBy('created', Query::DESC);

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

    public function saveArticleToDatabase(Article $article): bool
    {
        if (empty($this->getArticleById($article->getArticleId())) === true) {
            $query = $this->database->getNewInsertQuery(self::TABLE);
            $query->insert('articleId', $article->getArticleId()->toString());
            $query->insert('title', $article->getTitle()->getTitle());
            $query->insert('text', $article->getText()->getText());
            $query->insert('subtitle', $article->getSubtitle()->getTitle());
            $query->insert('userId', $article->getUserId()->toString());
            $query->insert('created', $article->getCreated()->toString());

            return $this->database->execute($query);
        }
        $query = $this->database->getNewUpdateQuery(self::TABLE);
        $query->where('articleId', '=', $article->getArticleId()->toString());
        $query->set('title', $article->getTitle()->getTitle());
        $query->set('text', $article->getText()->getText());
        $query->set('subtitle', $article->getSubtitle()->getTitle());
        $query->set('userId', $article->getUserId()->toString());
        $query->set('created', $article->getCreated()->toString());

        return $this->database->execute($query);

    }

    public function saveAuthorToAuthorArticleTable(Author $author, Id $articleId): bool
    {
        if(empty($this->getAuthorArticleByAuthorAndArticleId($author, $articleId)) === true) {
            $query = $this->database->getNewInsertQuery(self::TABLE_ARTICLE_AUTHOR);
            $query->insert('id', Id::generateId()->toString());
            $query->insert('articleId', $articleId->toString());
            $query->insert('authorId', $author->getAuthorId()->toString());

            return $this->database->execute($query);
        }
        return true;
    }

    public function getArticleById(Id $articleId)
    {
        $query = $this->database->getNewSelectQuery(self::TABLE);
        $query->where('articleId', '=', $articleId->toString());
        return $this->database->fetch($query);
    }

    public function deleteArticleInDatabase(Article $article): bool
    {
        $query = $this->database->getNewDeleteQuery(self::TABLE);
        $query->where('articleId', '=', $article->getArticleId()->toString());
        return $this->database->execute($query);
    }

    public function deleteAuthorArticleInDatabase(Article $article): bool
    {
        $query = $this->database->getNewDeleteQuery(self::TABLE_ARTICLE_AUTHOR);
        $query->where('articleId', '=', $article->getArticleId()->toString());
        return $this->database->execute($query);
    }

    public function savePictureToPictureArticleTable(Picture $picture, Id $articleId): bool
    {
        if(empty($this->getPictureArticleByPictureAndArticleId($picture, $articleId)) === true){
            $query = $this->database->getNewInsertQuery(self::TABLE_ARTICLE_PICTURE);
            $query->insert('id', Id::generateId()->toString());
            $query->insert('articleId', $articleId->toString());
            $query->insert('pictureId', $picture->getPictureId()->toString());

            return $this->database->execute($query);
        }
        return false;
    }

    public function getAuthorArticleByAuthorAndArticleId(Author $author, Id $articleId)
    {
        $query = $this->database->getNewSelectQuery(self::TABLE_ARTICLE_AUTHOR);
        $query->where('authorId', '=', $author->getAuthorId()->toString());
        $query->andWhere('articleId', '=', $articleId->toString());
        return $this->database->fetch($query);
    }

    public function getPictureArticleByPictureAndArticleId(Picture $picture, Id $articleId)
    {
        $query = $this->database->getNewSelectQuery(self::TABLE_ARTICLE_PICTURE);
        $query->where('pictureId', '=', $picture->getPictureId()->toString());
        $query->andWhere('articleId', '=', $articleId->toString());
        return $this->database->fetch($query);
    }
}