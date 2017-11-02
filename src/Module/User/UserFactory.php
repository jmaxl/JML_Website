<?php
declare(strict_types=1);

namespace JML\Module\User;

use JML\Module\GenericValueObject\Id;
use JML\Module\GenericValueObject\Mail;
use JML\Module\GenericValueObject\Name;

/**
 * Class UserFactory
 * @package JML\Module\User
 */
class UserFactory
{
    /**
     * @param $result
     * @return User
     */
    public function getUser($result): User
    {
        $userId = Id::fromString($result->userId);
        $firstname = Name::fromString($result->firstname);
        $username = Name::fromString($result->username);
        $mail = Mail::fromString($result->mail);
        $userPassword = $result->password;
        $verified = false;
        if(isset($result->verified)){
            $verified = $result->verified;
        }

        $user = new User($userId, $firstname, $username, $mail, $userPassword, $verified);

        if ($result->name !== null){
            $name = Name::fromString($result->name);
            $user->setName($name);
        }

        return $user;
    }

    /**
     * @param $result
     * @param $password
     * @return User
     * @throws \Exception
     */
    public function getLoggedInUserByPassword($result, $password): User
    {
        $user = $this->getUser($result);
        if ($user->logInUser($password) === false) {
            throw new \Exception('Wrong password, try again!');
        }

        return $user;
    }
}