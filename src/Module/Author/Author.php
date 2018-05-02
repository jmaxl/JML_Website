<?php
declare (strict_types=1);

namespace JML\Module\Author;

use JML\Module\DefaultModel;
use JML\Module\GenericValueObject\Id;
use JML\Module\GenericValueObject\Name;
use JML\Module\User\User;
use JML\Module\User\UserService;

/**
 * Class Author
 * @package JML\Module\Author
 */
class Author extends DefaultModel
{
    /** @var Id $authorId */
    protected $authorId;

    /** @var Id $userId */
    protected $userId;

    /** @var Name $firstname */
    protected $firstname;

    /** @var  Name $name */
    protected $name;

    /** @var  User $user */
    protected $user;

    /**
     * Author constructor.
     * @param Id $authorId
     */
    public function __construct(Id $authorId)
    {
        $this->authorId = $authorId;
    }

    /**
     * @return Id
     */
    public function getAuthorId(): Id
    {
        return $this->authorId;
    }

    /**
     * @return Id
     */
    public function getUserId(): ?Id
    {
        return $this->userId;
    }

    /**
     * @return Name
     */
    public function getFirstname(): ?Name
    {
        return $this->firstname;
    }

    /**
     * @param Name $firstname
     */
    public function setFirstname(Name $firstname): void
    {
        $this->firstname = $firstname;
    }

    /**
     * @return mixed
     */
    public function getName(): ?Name
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * @param Id $userId
     */
    public function setUserId(Id $userId): void
    {
        $this->userId = $userId;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(Id $userId): void
    {
        $userService = new UserService($this->database);
        $user = $userService->getUserById($userId);
        $this->user = $user;
    }
}