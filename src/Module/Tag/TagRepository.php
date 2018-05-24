<?php
declare (strict_types=1);


namespace JML\Module\Tag;

use JML\Module\Database\Database;
use JML\Module\GenericValueObject\Id;

/**
 * Class TagRepository
 * @package JML\Module\Tag
 */
class TagRepository
{
    /** @var string TABLE */
    protected const TABLE = 'tag';

    /** @var  Database $database */
    protected $database;

    /**
     * TagRepository constructor.
     * @param Database $database
     */
    public function __construct(Database $database)
    {
        $this->database = $database;
    }

    /**
     * @param Id $tagId
     * @return mixed
     */
    public function getTagByTagId(Id $tagId)
    {
        $query = $this->database->getNewSelectQuery(self::TABLE);
        $query->where('tagId', '=', $tagId->toString());

        return $this->database->fetch($query);
    }
}