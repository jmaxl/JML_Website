<?php
declare (strict_types=1);

namespace JML\Module\Author;

use JML\Module\Database\Database;
use JML\Module\GenericValueObject\Id;
use JML\Module\GenericValueObject\Name;

/**
 * Class AuthorService
 * @package JML\Module\Author
 */
class AuthorService
{
    /** @var AuthorRepository $authorRepository */
    protected $authorRepository;

    /** @var AuthorFactory $authorFactory */
    protected $authorFactory;

    /**
     * AuthorService constructor.
     * @param Database $database
     */
    public function __construct(Database $database)
    {
        $this->authorRepository = new AuthorRepository($database);
        $this->authorFactory = new AuthorFactory();
    }

    /**
     * @param Name $firstName
     * @return Author
     */
    public function getAuthorByFirstname(Name $firstName): Author
    {
        $result = $this->authorRepository->getAuthorByFirstname($firstName);

        return $this->authorFactory->getAuthor($result);
    }

    /**
     * @param Id $authorId
     * @return Author
     */
    public function getAuthorByAuthorId(Id $authorId): Author
    {
        $result = $this->authorRepository->getAuthorByAuthorId($authorId);

        return $this->authorFactory->getAuthor($result);
    }

    public function getAuthorList(): array
    {
        $authorList = [];
        $result = $this->authorRepository->getAuthorList();

        foreach ( $result as $authorData){

            $author = $this->authorFactory->getAuthor($authorData);
            $authorList[] = $author;
        }
        return $authorList;
    }

    public function deleteAuthorInDatabase(Author $author): bool
    {
        return $this->authorRepository->deleteAuthorInDatabase($author);
    }

}