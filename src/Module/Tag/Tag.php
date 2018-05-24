<?php
declare (strict_types=1);


namespace JML\Module\Tag;

use JML\Module\GenericValueObject\Id;

/**
 * Class Tag
 * @package JML\Module\Tag
 */
class Tag
{
    /** @var  Id $tagId */
    protected $tagId;

    /** @var  TagName $tagName */
    protected $tagName;

    /**
     * Tag constructor.
     * @param Id $tagId
     * @param TagName $tagName
     */
    public function __construct(Id $tagId, TagName $tagName)
    {
        $this->tagId = $tagId;
        $this->tagName = $tagName;
    }

    /**
     * @return Id
     */
    public function getTagId(): Id
    {
        return $this->tagId;
    }

    /**
     * @return TagName
     */
    public function getTagName(): TagName
    {
        return $this->tagName;
    }
}