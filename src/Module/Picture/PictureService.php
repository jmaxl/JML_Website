<?php
declare (strict_types=1);


namespace JML\Module\Picture;

use JML\Module\Database\Database;
use JML\Module\GenericValueObject\Id;

class PictureService
{
    protected $pictureRepository;
    protected $pictureFactory;

    /**
     * PictureService constructor.
     * @param Database $database
     */
    public function __construct(Database $database)
    {
        $this->pictureRepository = new PictureRepository($database);
        $this->pictureFactory = new PictureFactory();
    }

    /**
     * @param Id $articleId
     * @return array
     */
    public function getAllPicturesByArticleId(Id $articleId): array
    {
        $pictureArray = [];
        $articlePictures = $this->pictureRepository->getAllPictureIdsByArticleId($articleId);
        foreach ($articlePictures as $articlePicture) {
            $pictureId = Id::fromString($articlePicture->pictureId);
            $pictureData = $this->pictureRepository->getPictureByPictureId($pictureId);
            $picture = $this->pictureFactory->getPicture($pictureData);
            $pictureArray[] = $picture;
        }
        return $pictureArray;
    }


}