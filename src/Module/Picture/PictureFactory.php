<?php
declare (strict_types=1);


namespace JML\Module\Picture;

use JML\Module\GenericValueObject\Datetime;
use JML\Module\GenericValueObject\Id;
use JML\Module\GenericValueObject\Image;
use JML\Module\GenericValueObject\Link;
use JML\Module\GenericValueObject\Title;

/**
 * Class PictureFactory
 * @package JML\Module\Picture
 */
class PictureFactory
{
    /**
     * @param $pictureData
     * @return Picture
     */
    public function getPicture($pictureData): Picture
    {
        $pictureId = Id::fromString($pictureData->pictureId);
        $pictureUrl = Image::fromFile($pictureData->pictureUrl);
        $userId = Id::fromString($pictureData->userId);
        $created = Datetime::fromValue($pictureData->created);

        $picture = new Picture($pictureId, $pictureUrl, $userId, $created);

        if ($pictureData->title !== null) {
            $title = Title::fromString($pictureData->title);
            $picture->setTitle($title);
        }

        if ($pictureData->authorId !== null) {
            $authorId = Id::fromString($pictureData->authorId);
            $picture->setAuthorId($authorId);
        }

        return $picture;
    }

    public function createNewPicture(Image $pictureUrl, Id $userId): Picture
    {
        $pictureId = Id::generateId();
        $created = Datetime::fromValue('now');
        $picture = new Picture($pictureId, $pictureUrl, $userId, $created);
        return $picture;
    }
}