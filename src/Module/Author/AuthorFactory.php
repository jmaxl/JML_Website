<?php
declare (strict_types=1);

namespace JML\Module\Author;

use JML\Module\GenericValueObject\Id;
use JML\Module\GenericValueObject\Name;

/**
 * Class AuthorFactory
 * @package JML\Module\Author
 */
class AuthorFactory
{
    /**
     * @todo REFACTORING | null return ok?
     * @param $result
     * @return Author|null
     */
    public function getAuthor($result): ?Author
    {
        if (empty($result->userId) === false){
            $userId = Id::fromString($result->userId);
        }

        if (empty($result->firstname) === false){
            $firstname = Name::fromString($result->firstname);
        }

        if (isset($userId) || isset($firstname)){
            $authorId = Id::fromString($result->authorId);
            $author = new Author($authorId);

            if (empty($result->name) === false) {
                $name = Name::fromString($result->name);
                $author->setName($name);
            }

            if (empty($result->user) === false) {
                $userId = Id::fromString($result->userId);
                $author->setUser($userId);
            }

            //* if (empty($userId) === false){
            //*     $author->setUserId($userId);
            //* }

            if (empty($firstname) === false){
                $author->setFirstname($firstname);
            }

            return $author;
        }

        return null;
    }
}