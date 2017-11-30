<?php
declare (strict_types=1);


namespace JML\Module\Picture;

use JML\Module\Database\Database;
use JML\Module\GenericValueObject\Id;

class PictureRepository
{
    const TABLE = 'article_picture';
    const TABLE_PICTURE = 'picture';

    protected $database;

    /**
     * PictureRepository constructor.
     * @param Database $database
     */
    public function __construct(Database $database)
    {
        $this->database = $database;
    }

    /**
     * @param Id $articleId
     * @return array
     */
    public function getAllPictureIdsByArticleId(Id $articleId): array
    {
        $query = $this->database->getNewSelectQuery(self::TABLE);
        $query->where('articleId', '=', $articleId->toString());

        return $this->database->fetchAll($query);
    }

    /**
     * @param Id $pictureId
     * @return mixed
     */
    public function getPictureByPictureId(Id $pictureId)
    {
        $query = $this->database->getNewSelectQuery(self::TABLE_PICTURE);
        $query->where('pictureId', '=', $pictureId->toString());

        return $this->database->fetch($query);
    }
}