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
     * @param $result
     * @return Author
     */
    public function getAuthor($result): Author
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

            if (isset($userId)){
                $author->setUserId($userId);
            }

            if (isset($firstname)){
                $author->setFirstname($firstname);
            }
        }








        return $author;
    }
}