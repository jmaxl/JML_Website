<?php
declare(strict_types=1);


namespace JML\Module\User;


use JML\Module\Database\Database;
use JML\Module\GenericValueObject\Id;
use JML\Module\GenericValueObject\Mail;

class UserService
{
    protected $userRepository;
    protected $userFactory;

    public function __construct(Database $database)
    {
        $this->userRepository = new UserRepository($database);
        $this->userFactory = new UserFactory();
    }

    public function getLoggedInUserByMail(Mail $mail, $password): User
    {
        $result = $this->userRepository->getUserByMail($mail);

        if (count($result) !== 1) {
            throw new \Exception('Mail not found!');
        }

        return $this->userFactory->getLoggedInUserByPassword($result[0], $password);
    }

    public function getUserById(Id $id): User
    {
        $result = $this->userRepository->getUserById($id);

        if (count($result) !== 1) {
            throw new \Exception('User not found!');
        }

        return $this->userFactory->getUser($result);
    }
}


