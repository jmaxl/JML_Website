<?php
declare(strict_types=1);

namespace JML\Module\User;

use JML\Module\Database\Database;
use JML\Module\GenericValueObject\Id;
use JML\Module\GenericValueObject\Mail;

/**
 * Class UserRepository
 * @package JML\Module\User
 */
class UserRepository
{
    const TABLE = 'user';

    /** @var Database $database */
    protected $database;

    /**
     * UserRepository constructor.
     * @param Database $database
     */
    public function __construct(Database $database)
    {
        $this->database = $database;
    }

    /**
     * @param Mail $mail
     * @return mixed
     */
    public function getUserByMail(Mail $mail)
    {
        $query = $this->database->getNewSelectQuery(self::TABLE);
        $query->where('mail', '=', $mail->getMail());

        return $this->database->fetch($query);
    }

    /**
     * @param Id $id
     * @return mixed
     */
    public function getUserById(Id $id)
    {
        $query = $this->database->getNewSelectQuery(self::TABLE);
        $query->where('userId', '=', $id->toString());

        return $this->database->fetch($query);
    }

    /**
     * @param User $user
     * @return bool
     */
    public function saveUser(User $user): bool
    {
        $query = $this->database->getNewInsertQuery(self::TABLE);
        $query->insert('userId', $user->getUserId()->toString());
        $query->insert('firstname', $user->getFirstname()->getName());
        $query->insert('username', $user->getUsername()->getName());
        $query->insert('mail', $user->getMail()->getMail());
        $query->insert('password', $user->getPassword());

        if($user->getName() !== null){
            $query->insert('name', $user->getName()->getName());
        }

        return $this->database->execute($query);
    }

    public function getAllUser(): array
    {
        $query = $this->database->getNewSelectQuery(self::TABLE);
        return $this->database->fetchAll($query);
    }
}