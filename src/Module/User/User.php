<?php

namespace JML\Module\User;

use JML\Module\GenericValueObject\Id;
use JML\Module\GenericValueObject\Name;

class User
{
    /** @var Id $userId */
    protected $userId;

    /** @var Name $firstname */
    protected $firstname;

    /** @var Name $name */
    protected $name;

    /** @var Name $username */
    protected $username;

    /** @var  $mail */
    protected $mail;

    /** @var  $password */
    protected $password;

    /** @var  $avatarUrl */
    protected $avatarUrl;

    /** @var bool $verified */
    protected $verified;

    /** @var  bool $isLoggedIn */
    protected $isLoggedIn;

    /**
     * User constructor.
     * @param Id $userId
     * @param Name $firstname
     * @param Name $username
     * @param $mail
     * @param $password
     * @param bool $verified
     */
    public function __construct(Id $userId, Name $firstname, Name $username, $mail, $password, Bool $verified)
    {
        $this->userId = $userId;
        $this->firstname = $firstname;
        $this->username = $username;
        $this->mail = $mail;
        $this->password = $password;
        $this->verified = $verified;
        $this->isLoggedIn = false;
    }

    public function logInUser($password): bool
    {
        if ($this->password === $password) {
         $this->isLoggedIn = true;
        } else {
            $this->isLoggedIn = false;
        }
        return $this->isLoggedIn;
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

    /**
     * @return Name
     */
    public function getUsername(): Name
    {
        return $this->username;
    }

    /**
     * @param Name $username
     */
    public function setUsername(Name $username)
    {
        $this->username = $username;
    }

    /**
     * @return mixed
     */
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * @param mixed $mail
     */
    public function setMail($mail)
    {
        $this->mail = $mail;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getAvatarUrl()
    {
        return $this->avatarUrl;
    }

    /**
     * @param mixed $avatarUrl
     */
    public function setAvatarUrl($avatarUrl)
    {
        $this->avatarUrl = $avatarUrl;
    }

    /**
     * @return bool
     */
    public function isVerified(): bool
    {
        return $this->verified;
    }

    /**
     * @param bool $verified
     */
    public function setVerified(bool $verified)
    {
        $this->verified = $verified;
    }
}
