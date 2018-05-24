<?php
declare(strict_types=1);

namespace JML\Module\User;

use JML\Module\DefaultModel;
use JML\Module\GenericValueObject\Id;
use JML\Module\GenericValueObject\Mail;
use JML\Module\GenericValueObject\Name;

/**
 * Class User
 * @package JML\Module\User
 */
class User extends DefaultModel
{
    /** @var Id $userId */
    protected $userId;

    /** @var Name $firstname */
    protected $firstname;

    /** @var Name $name */
    protected $name;

    /** @var Name $username */
    protected $username;

    /** @var Mail $mail */
    protected $mail;

    /** @var  $password */
    protected $password;

    /** @var  $avatarUrl */
    protected $avatarUrl;

    /** @var bool $verified */
    protected $verified;

    /** @var  bool $isLoggedIn */
    protected $isLoggedIn;

    /** @var  bool $isAdmin*/
    protected $isAdmin;

    /**
     * User constructor.
     * @param Id $userId
     * @param Name $firstname
     * @param Name $username
     * @param Mail $mail
     * @param $password
     * @param bool $verified
     */
    public function __construct(Id $userId, Name $firstname, Name $username, Mail $mail, $password, Bool $verified)
    {
        $this->userId = $userId;
        $this->firstname = $firstname;
        $this->username = $username;
        $this->mail = $mail;
        $this->password = $password;
        $this->verified = $verified;
        $this->isLoggedIn = false;
        $this->isAdmin = false;
    }

    /**
     * @param $password
     * @return bool
     */
    public function logInUser($password): bool
    {
        if ($this->password === $password) {
            $this->logInSuccessUser();
        } else {
            $this->logOutUser();
        }
        return $this->isLoggedIn;
    }

    protected function logInSuccessUser()
    {
        $this->isLoggedIn = true;
        $_SESSION['userId'] = $this->userId->toString();
    }

    protected function logOutUser()
    {
        $this->isLoggedIn = false;
        unset($_SESSION['userId']);
    }

    public function logInBySession(): bool
    {
        if(isset($_SESSION['userId']) && $_SESSION['userId'] === $this->userId->toString()){
            $this->logInSuccessUser();
            return true;
        }
        $this->logOutUser();
        return false;
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
    public function getName(): ?Name
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName(Name $name)
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
     * @return Mail
     */
    public function getMail(): Mail
    {
        return $this->mail;
    }

    /**
     * @param  Mail $mail
     */
    public function setMail(Mail $mail)
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

    public function setIsAdmin(bool $isAdmin)
    {
        $this->isAdmin = $isAdmin;
    }

    public function isAdmin(): bool
    {
        return $this->isAdmin;
    }
}