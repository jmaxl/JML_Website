<?php
declare (strict_types=1);

namespace JML\Module\Author;

use JML\Module\Database\Database;
use JML\Module\Database\Query;
use JML\Module\GenericValueObject\Id;
use JML\Module\GenericValueObject\Name;

/**
 * Class AuthorRepository
 * @package JML\Module\Author
 */
class AuthorRepository
{
    const TABLE = 'author';
    const TABLE_ARTICLE_AUTHOR = 'article_author';

    /** @var Database $database */
    protected $database;

    /**
     * AuthorRepository constructor.
     * @param Database $database
     */
    public function __construct(Database $database)
    {
        $this->database = $database;
    }

    /**
     * @param Name $firstname
     * @return mixed
     */
    public function getAuthorByFirstname(Name $firstname)
    {
        $query = $this->database->getNewSelectQuery(self::TABLE);
        $query->where('firstname', '=', $firstname->getName());

        return $this->database->fetch($query);
    }

    /**
     * @param Id $authorId
     * @return mixed
     */
    public function getAuthorByAuthorId(Id $authorId)
    {
        $query = $this->database->getNewSelectQuery(self::TABLE);
        $query->where('authorId', '=', $authorId->toString());

        return $this->database->fetch($query);
    }

    public function getAuthorList(): array
    {
        $query = $this->database->getNewSelectQuery(self::TABLE);
        $query->orderBy('name', Query::ASC);

        return $this->database->fetchAll($query);
    }

    public function deleteAuthorInDatabase(Author $author): bool
    {
        $query = $this->database->getNewDeleteQuery(self::TABLE);
        $query->where('authorId', '=', $author->getAuthorId()->toString());
        return $this->database->execute($query);
    }

    public function saveAuthorInDatabase(Author $author): bool
    {
        $saveAuthor = true;
        if ($author->getUser() !== null && empty($this->getAuthorByUserId($author->getUser()->getUserId())) === false) {
            $saveAuthor = false;
        }
        if ($author->getFirstname() !== null && $author->getName() !== null && empty($this->getAuthorByFirstnameAndName($author->getFirstname(), $author->getName())) === false) {
            $saveAuthor = false;
        }
        if ($saveAuthor === true) {
            $query = $this->database->getNewInsertQuery(self::TABLE);
            $query->insert('authorId', $author->getAuthorId()->toString());
            if ($author->getFirstname() !== null) {
                $query->insert('firstname', $author->getFirstname()->getName());
            }
            if ($author->getName() !== null) {
                $query->insert('name', $author->getName()->getName());
            }
            if ($author->getUser() !== null) {
                $query->insert('userId', $author->getUser()->getUserId()->toString());
            }
            return $this->database->execute($query);
        }
        return false;
    }

    protected function getAuthorByUserId(Id $userId)
    {
        $query = $this->database->getNewSelectQuery(self::TABLE);
        $query->where('userId', '=', $userId->toString());

        return $this->database->fetch($query);
    }

    protected function getAuthorByFirstnameAndName(Name $firstname, Name $name)
    {
        $query = $this->database->getNewSelectQuery(self::TABLE);
        $query->where('firstname', '=', $firstname->getName());
        $query->andWhere('name', '=', $name->getName());
        return $this->database->fetch($query);
    }
}