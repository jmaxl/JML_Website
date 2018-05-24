<?php
declare(strict_types=1);

namespace JML\Module\User;

use JML\Module\Author\Author;
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
    public function getUserByParams(array $params): ?User
    {
        $object = (object)$params;
        $object->verified = true;
        $object->userId = Id::generateId()->toString();

        return $this->userFactory->getUser($object);
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

    public function getAllNonAuthorUser(array $authorList): array
    {
        $userArray = [];
        $userList = $this->userRepository->getAllUser();

        foreach ($userList as $userData) {
            $user = $this->userFactory->getUser($userData);
            $isAuthor = false;
            /** @var Author $author */
            foreach ($authorList as $author) {
                if ($author->getUser() !== null && $author->getUser()->getUserId()->toString() === $user->getUserId()->toString()) {
                    $isAuthor = true;
                }
            }
            if ($isAuthor === false) {
                $userArray[] = $user;
            }
        }

        return $userArray;
    }

    public function saveUserToDatabase(User $user): bool
    {
        return $this->userRepository->saveUser($user);
    }

}


