<?php
/**
 * Created by PhpStorm.
 * User: jml
 * Date: 27.09.17
 * Time: 22:36
 */

namespace JML;


use JML\Module\GenericValueObject\Id;
use JML\Module\GenericValueObject\Name;

class Author
{
    /** @var Id $authorId */
    protected $authorId;

    /** @var Id $userId */
    protected $userId;

    /** @var Name $firstname */
    protected $firstname;

    /** @var  Name $name */
    protected $name;

    /**
     * Author constructor.
     * @param Id $authorId
     * @param Id $userId
     * @param Name $firstname
     */
    public function __construct(Id $authorId, Id $userId, Name $firstname)
    {
        $this->authorId = $authorId;
        $this->userId = $userId;
        $this->firstname = $firstname;
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
    public function getUserId(): Id
    {
        return $this->userId;
    }

    /**
     * @return Name
     */
    public function getFirstname(): Name
    {
        return $this->firstname;
    }

    /**
     * @param Name $firstname
     */
    public function setFirstname(Name $firstname)
    {
        $this->firstname = $firstname;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }
}