<?php
declare (strict_types=1);


namespace JML\Module\Author;

use JML\Module\Database\Database;
use JML\Module\GenericValueObject\Name;

class AuthorRepository
{
    const TABLE = 'author';
    protected $databse;

    public function __construct(Database $database)
    {
        $this->database = $database;
    }

    public function getAuthorByFirstname(Name $firstname)
    {
        $query = $this->database->getNewSelectQuery(self::TABLE);
        $query->where('firstname', '=', $firstname->getName());
        return $this->database->fetch($query);
    }

}