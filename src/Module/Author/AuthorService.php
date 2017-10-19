<?php
declare (strict_types=1);


namespace JML\Module\Author;

use JML\Author;
use JML\AuthorFactory;
use JML\AuthorRepository;
use JML\Module\Database\Database;

class AuthorService
{
    protected $authorRepository;
    protected $authorFactory;

    public function __construct(Database $database)
    {
        $this->authorRepository = new AuthorRepository($database);
        $this->authorFactory = new AuthorFactory();
    }

    public function getAuthorByFirstname(): Author
    {
        $result = $this->authorRepository->getAuthorByFirstname();
        return $this->authorFactory->getAuthor($result);
    }
}