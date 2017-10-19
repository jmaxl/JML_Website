<?php
declare (strict_types=1);


namespace JML\Module\Author;

use JML\Author;
use JML\Module\GenericValueObject\Id;
use JML\Module\GenericValueObject\Name;

class AuthorFactory
{
    public function getAuthor($result): Author
    {
        $authorId = Id::fromString($result->authorId);
        $userId = Id::fromString($result->userId);
        $firstname = Name::fromString($result->firstname);


        $author = new Author($authorId, $userId, $firstname);

        if ($result->name !== null){
            $name = Name::fromString($result->name);
            $author->setName($name);
        }

        return $author;
    }
}