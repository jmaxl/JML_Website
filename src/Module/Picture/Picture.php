<?php
/**
 * Created by PhpStorm.
 * User: jml
 * Date: 21.09.17
 * Time: 22:47
 */

namespace Project\Module\Picture;


use Project\Module\GenericValueObject\Datetime;
use Project\Module\GenericValueObject\Id;
use Project\Module\GenericValueObject\Link;
use Project\Module\GenericValueObject\Title;

class Picture
{
    /** @var  Id $pictureId */
    protected $pictureId;

    /** @var  Title $title */
    protected $title;

    /** @var  Link $pictureUrl */
    protected $pictureUrl;

    /** @var  Id $authorId */
    protected $authorId;

    /** @var  Id $userId */
    protected $userId;

    /** @var  Datetime $created */
    protected $created;

    public function __construct(Id $pictureId, Link $pictureUrl, Id $userId, Datetime $created)
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
    public function getTitle(): Title
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
     * @return Link
     */
    public function getPictureUrl(): Link
    {
        return $this->pictureUrl;
    }

    /**
     * @param Link $pictureUrl
     */
    public function setPictureUrl(Link $pictureUrl)
    {
        $this->pictureUrl = $pictureUrl;
    }

    /**
     * @return Id
     */
    public function getAuthorId(): Id
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