<?php
declare (strict_types=1);


namespace JML\Module\Picture;

use JML\Module\Database\Database;
use JML\Module\Database\Query;
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

    public function savePictureToDatabase(Picture $picture): bool
    {
        if (empty($this->getPictureByPictureId($picture->getPictureId())) === true) {
            $query = $this->database->getNewInsertQuery(self::TABLE_PICTURE);
            $query->insert('pictureId', $picture->getPictureId()->toString());
            $query->insert('pictureUrl', $picture->getPictureUrl()->toString());
            $query->insert('userId', $picture->getUserId()->toString());
            $query->insert('created', $picture->getCreated()->toString());

            if($picture->getTitle() !== null) {
                $query->insert('title', $picture->getTitle()->getTitle());
            }

            if($picture->getAuthorId() !== null) {
                $query->insert('authorId', $picture->getAuthorId()->toString());
            }

            return $this->database->execute($query);
        }

        $query = $this->database->getNewUpdateQuery(self::TABLE_PICTURE);
        $query->set('pictureUrl', $picture->getPictureUrl()->toString());
        $query->set('userId', $picture->getUserId()->toString());
        $query->set('created', $picture->getCreated()->toString());
        $query->where('pictureId', '=', $picture->getPictureId()->toString());

        if($picture->getTitle() !== null) {
            $query->set('title', $picture->getTitle()->getTitle());
        }

        if($picture->getAuthorId() !== null) {
            $query->set('authorId', $picture->getAuthorId()->toString());
        }

        return $this->database->execute($query);
    }

    public function getPictureList(): array
    {
        $query = $this->database->getNewSelectQuery(self::TABLE);
        $query->orderBy('name', Query::ASC);

        return $this->database->fetchAll($query);
    }

    public function deletePictureInArticlePictureDatabase(Picture $picture): bool
    {
        $query = $this->database->getNewDeleteQuery(self::TABLE);
        $query->where('pictureId', '=', $picture->getPictureId()->toString());
        return $this->database->execute($query);
    }
}