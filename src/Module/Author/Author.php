<?php
declare (strict_types=1);

namespace JML\Module\Author;

use JML\Module\DefaultModel;
use JML\Module\GenericValueObject\Id;
use JML\Module\GenericValueObject\Name;
use JML\Module\User\User;

/**
 * Class Author
 * @package JML\Module\Author
 */
class Author extends DefaultModel
{
    /** @var Id $authorId */
    protected $authorId;

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
     * @return Name
     */
    public function getFirstname(): ?Name
    {
        if ($this->firstname !== null) {
            return $this->firstname;
        }

        if ($this->user !== null) {
            return $this->user->getFirstname();
        }

        return null;
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
        if ($this->name !== null) {
            return $this->name;
        }

        if ($this->user !== null) {
            return $this->user->getName();
        }

        return null;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(User $user): void
    {
        $this->user = $user;
    }
}