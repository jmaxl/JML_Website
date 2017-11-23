<?php
declare (strict_types=1);

namespace JML\Module\Author;

use JML\Module\Database\Database;
use JML\Module\GenericValueObject\Id;
use JML\Module\GenericValueObject\Name;

/**
 * Class AuthorRepository
 * @package JML\Module\Author
 */
class AuthorRepository
{
    const TABLE = 'author';

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
}