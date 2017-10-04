<?php
/**
 * Created by PhpStorm.
 * User: jml
 * Date: 28.09.17
 * Time: 21:15
 */

namespace JML\Module\User;


use JML\Module\Database\Database;

class UserRepository
{
    public function getUserByMail($mail): array
    {
        $database = Database::getInstance();
        return $database->fetchByStringParameter('user', 'mail', $mail);
    }

    public function getUserByID($Id): array
    {
        $database = Database::getInstance();
        return $database->fetchById('user', 'userId', $Id);
    }

}