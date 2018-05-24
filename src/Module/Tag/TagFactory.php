<?php
declare (strict_types=1);


namespace JML\Module\Tag;

use JML\Module\GenericValueObject\Id;

/**
 * Class TagFactory
 * @package JML\Module\Tag
 */
class TagFactory
{
    /**
     * @param $result
     * @return Tag
     */
    public function getTag($result): Tag
    {
        $tagId = Id::fromString($result->tagId);
        $tagName = TagName::fromString($result->tagName);

        return new Tag($tagId, $tagName);
    }
}