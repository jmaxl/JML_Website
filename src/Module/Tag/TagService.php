<?php
declare (strict_types=1);


namespace JML\Module\Tag;

use JML\Module\Database\Database;
use JML\Module\GenericValueObject\Id;

/**
 * Class TagService
 * @package JML\Module\Tag
 */
class TagService
{
    /** @var  TagRepository $tagRepository */
    protected $tagRepository;

    /** @var  TagFactory $tagFactory */
    protected $tagFactory;

    /**
     * TagService constructor.
     */
    public function __construct(Database $database)
    {
        $this->tagRepository = new TagRepository($database);
        $this->tagFactory = new TagFactory();
    }

    /**
     * @param Id $tagId
     * @return Tag|null
     */
    public function getTagByTagId(Id $tagId): ?Tag
    {
        $result = $this->tagRepository->getTagByTagId($tagId);

        if (empty($result) === true) {
            return null;
        }

        return $this->tagFactory->getTag($result);
    }
}