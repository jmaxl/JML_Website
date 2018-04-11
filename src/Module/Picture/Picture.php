<?php
declare (strict_types=1);

namespace JML\Module\Picture;

use JML\Module\GenericValueObject\Datetime;
use JML\Module\GenericValueObject\Id;
use JML\Module\GenericValueObject\Image;
use JML\Module\GenericValueObject\Title;

/**
 * Class Picture
 * @package JML\Module\Picture
 */
class Picture
{
    /** @var  Id $pictureId */
    protected $pictureId;

    /** @var  Title $title */
    protected $title;

    /** @var Image $pictureUrl */
    protected $pictureUrl;

    /** @var  Id $authorId */
    protected $authorId;

    /** @var  Id $userId */
    protected $userId;

    /** @var  Datetime $created */
    protected $created;

    public function __construct(Id $pictureId, Image $pictureUrl, Id $userId, Datetime $created)
    {
        $this->pictureId = $pictureId;
        $this->pictureUrl = $pictureUrl;
        $this->userId = $userId;
        $this->created = $created;
    }

    /**
     * @return Id
     */
    public function getPictureId(): Id
    {
        return $this->pictureId;
    }

    /**
     * @return Title
     */
    public function getTitle(): ?Title
    {
        return $this->title;
    }

    /**
     * @param Title $title
     */
    public function setTitle(Title $title)
    {
        $this->title = $title;
    }

    /**
     * @return Image
     */
        public function getPictureUrl(): Image
    {
        return $this->pictureUrl;
    }

    /**
     * @param Image $pictureUrl
     */
    public function setPictureUrl(Image $pictureUrl)
    {
        $this->pictureUrl = $pictureUrl;
    }

    /**
     * @return Id
     */
    public function getAuthorId(): ?Id
    {
        return $this->authorId;
    }

    /**
     * @param Id $authorId
     */
    public function setAuthorId(Id $authorId)
    {
        $this->authorId = $authorId;
    }

    /**
     * @return Id
     */
    public function getUserId(): Id
    {
        return $this->userId;
    }

    /**
     * @return Datetime
     */
    public function getCreated(): Datetime
    {
        return $this->created;
    }
}