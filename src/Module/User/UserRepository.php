<?php
declare(strict_types=1);


namespace JML\Module\User;


use JML\Module\Database\Database;
use JML\Module\GenericValueObject\Id;
use JML\Module\GenericValueObject\Mail;

class UserRepository
{
    protected $database;

    public function __construct(Database $database)
    {
        $this->database = $database;
    }

    public function getUserByMail(Mail $mail): array
    {
        return $this->database->fetchByStringParameter('user', 'mail', $mail->getMail());
    }

    public function getUserById(Id $id)
    {
        return $this->database->fetchById('user', 'userId', $id->toString());
    }
}