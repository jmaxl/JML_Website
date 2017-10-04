<?php
/**
 * Created by PhpStorm.
 * User: jml
 * Date: 28.09.17
 * Time: 21:14
 */

namespace JML\Module\User;


class UserService
{
    public function getLoggedInUserByMail($mail, $password): User
    {
        $userRepository = new UserRepository();
        $result = $userRepository->getUserByMail($mail);

        if (count($result) !== 1) {
            throw new \Exception('Mail not found!');
        }

        $userFactory = new UserFactory();
        return $userFactory->getLoggedInUserByPassword($result[0], $password);
    }

    public function getUserByID($Id): User
    {
        $userRespository = new UserRepository();
        $result = $userRespository->getUserById($Id);

        if (count($result) !== 1) {
            throw new \Exception('User not found!');
        }

        $userFactory = new UserFactory();
        return $userFactory->getUser($result[0]);
    }
}