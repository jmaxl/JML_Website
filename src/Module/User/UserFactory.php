<?php
/**
 * Created by PhpStorm.
 * User: jml
 * Date: 28.09.17
 * Time: 21:15
 */

namespace JML\Module\User;


use JML\Module\GenericValueObject\Id;
use JML\Module\GenericValueObject\Mail;
use JML\Module\GenericValueObject\Name;

class UserFactory
{
    public function getUser($result): User
    {
        $userId = Id::fromString($result->userId);
        $firstname = Name::fromString($result->firstname);
        $username = Name::fromString($result->username);
        $mail = Mail::fromString($result->mail);
        $userPassword = $result->password;
        $verified = (bool) $result->verified;

        $user = new User($userId, $firstname, $username, $mail, $userPassword, $verified);

        return $user;
    }

    public function getLoggedInUserByPassword($result, $password): User
    {
        $user = $this->getUser($result);

        /**$userId = Id::fromString($result->userId);
        $firstname = Name::fromString($result->firstname);
        $username = Name::fromString($result->username);
        $mail = $result->mail;
        $userPassword = $result->password;
        $verified = (bool) $result->verified;

        $user = new User($userId, $firstname, $username, $mail, $userPassword, $verified);*/

        if ($user->logInUser($password) === false){
            throw new \Exception('Wrong password, try again!');
        }
        return $user;
    }

}