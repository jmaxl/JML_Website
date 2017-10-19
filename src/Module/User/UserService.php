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

        return $this->userFactory->getLoggedInUserByPassword($result, $password);
    }

    public function getUserById(Id $id): User
    {
        $result = $this->userRepository->getUserById($id);

        if (count($result) !== 1) {
            throw new \Exception('User not found!');
        }

        return $this->userFactory->getUser($result);
    }

    public function saveUser(): bool
    {
        $fake = new \stdClass();
        $fake->userId = Id::generateId()->toString();
        $fake->name = 'Melanie';
        $fake->firstname = 'Melanie';
        $fake->username = 'MelaniesMutti';
        $fake->mail = 'melanie@melanie.de';
        $fake->password = 'melanie123';

        $user = $this->userFactory->getUser($fake);

        return $this->userRepository->saveUser($user);
    }
}


