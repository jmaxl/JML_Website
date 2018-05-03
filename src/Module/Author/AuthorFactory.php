<?php
declare (strict_types=1);

namespace JML\Module\Author;

use JML\Module\GenericValueObject\Id;
use JML\Module\GenericValueObject\Name;
use JML\Module\User\User;

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
    public function getAuthor($result, ?User $user): ?Author
    {
        $firstname = null;

        if (empty($result->firstname) === false) {
            $firstname = Name::fromString($result->firstname);
        }

        if ($user !== null || $firstname !== null) {
            $authorId = Id::fromString($result->authorId);
            $author = new Author($authorId);

            if (empty($result->name) === false) {
                $name = Name::fromString($result->name);
                $author->setName($name);
            }

            if ($user !== null) {
                $author->setUser($user);
            }

            if ($firstname !== null) {
                $author->setFirstname($firstname);
            }

            return $author;
        }

        return null;
    }
}