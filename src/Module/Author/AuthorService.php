<?php
declare (strict_types=1);

namespace JML\Module\Author;

use JML\Module\Database\Database;
use JML\Module\GenericValueObject\Id;
use JML\Module\GenericValueObject\Name;
use JML\Module\User\User;
use JML\Module\User\UserService;

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

    /** @var  UserService $userService */
    protected $userService;

    /**
     * AuthorService constructor.
     * @param Database $database
     */
    public function __construct(Database $database)
    {
        $this->authorRepository = new AuthorRepository($database);
        $this->authorFactory = new AuthorFactory();
        $this->userService = new UserService($database);

    }

    /**
     * @param Name $firstName
     * @return Author
     */
    public function getAuthorByFirstname(Name $firstName): Author
    {
        $result = $this->authorRepository->getAuthorByFirstname($firstName);
        $user = $this->getUserFromObject($result);
        return $this->authorFactory->getAuthor($result, $user);
    }

    /**
     * @param Id $authorId
     * @return Author
     */
    public function getAuthorByAuthorId(Id $authorId): Author
    {
        $result = $this->authorRepository->getAuthorByAuthorId($authorId);
        $user = $this->getUserFromObject($result);
        return $this->authorFactory->getAuthor($result, $user);
    }

    public function getAuthorList(): array
    {
        $authorList = [];
        $result = $this->authorRepository->getAuthorList();

        foreach ($result as $authorData) {
            $user = $this->getUserFromObject($authorData);
            $author = $this->authorFactory->getAuthor($authorData, $user);
            $authorList[] = $author;
        }
        return $authorList;
    }

    public function deleteAuthorInDatabase(Author $author): bool
    {
        if($this->authorRepository->deleteAuthorInDatabase($author) === true){
            $this->authorRepository->deleteAuthorArticleInDatabase($author);
        }
        return false;
    }

    public function getAuthorByParams(array $params): ?Author
    {
        $object = (object)$params;

        if (empty($object->authorId)) {
            $object->authorId = Id::generateId()->toString();
        }
        $user = $this->getUserFromObject($object);
        return $this->authorFactory->getAuthor($object, $user);
    }

    public function saveAuthorToDatabase(Author $author): bool
    {
        return $this->authorRepository->saveAuthorInDatabase($author);
    }

    protected function getUserFromObject($object): ?User
    {
        if (empty($object->userId) === false) {
            return $this->userService->getUserById(Id::fromString($object->userId));
        }

        return null;
    }
}