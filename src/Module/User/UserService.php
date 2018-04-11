<?php
declare(strict_types=1);

namespace JML\Module\User;

use JML\Module\Database\Database;
use JML\Module\GenericValueObject\Id;
use JML\Module\GenericValueObject\Mail;

/**
 * Class UserService
 * @package JML\Module\User
 */
class UserService
{
    /** @var UserRepository $userRepository */
    protected $userRepository;

    /** @var UserFactory $userFactory */
    protected $userFactory;

    /**
     * UserService constructor.
     * @param Database $database
     */
    public function __construct(Database $database)
    {
        $this->userRepository = new UserRepository($database);
        $this->userFactory = new UserFactory();
    }

    /**
     * @param Mail $mail
     * @param      $password
     * @return User
     * @throws \Exception
     */
    public function getLoggedInUserByMail(Mail $mail, $password): ?User
    {
        $result = $this->userRepository->getUserByMail($mail);

        if (count($result) !== 1) {
            return null;
        }

        return $this->userFactory->getLoggedInUserByPassword($result, $password);
    }

    public function getLoggedInUserByUserId(Id $userId): ?User
    {
        $user = $this->getUserById($userId);
        if ($user === null) {
            return null;
        }
        if ($user->logInBySession() === true) {
            return $user;
        }
        return null;
    }

    /**
     * @param Id $id
     * @return User
     * @throws \Exception
     */
    public function getUserById(Id $id): ?User
    {
        $result = $this->userRepository->getUserById($id);

        if (count($result) !== 1) {
            return null;
        }

        return $this->userFactory->getUser($result);
    }

    /**
     * @todo remove fake data and use it correct
     * @return bool
     */
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

    public function getAllUser(): array
    {
        $user = [];
        $result = $this->userRepository->getAllUser();

        foreach ($result as $userData) {
            $user[] = $this->userFactory->getUser($userData);
        }

        return $user;
    }
}


