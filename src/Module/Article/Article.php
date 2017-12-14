<?php
declare (strict_types=1);

namespace JML\Module\Article;

use JML\Module\Author\Author;
use JML\Module\GenericValueObject\Id;
use JML\Module\GenericValueObject\Title;
use JML\Module\GenericValueObject\Text;
use JML\Module\GenericValueObject\Datetime;
use JML\Module\Picture\Picture;

/**
 * Class Article
 * @package JML\Module\Article
 */
class Article
{
    /** @var Id $articleId */
    protected $articleId;

    /** @var Title $title */
    protected $title;

    /** @var  Title $subtitle */
    protected $subtitle;

    /** @var Text $text */
    protected $text;

    /** @var  $userId */
    protected $userId;

    /** @var Datetime $created */
    protected $created;

    /** @var  array $authorList */
    protected $authorList = [];

    /** @var array $pictureList */
    protected $pictureList = [];

    /**
     * Article constructor.
     * @param Id $articleId
     * @param Title $title
     * @param Text $text
     * @param Id $userId
     * @param Datetime $created
     */
    public function __construct(Id $articleId, Title $title, Text $text, Id $userId, Datetime $created)
    {
        $this->articleId = $articleId;
        $this->title = $title;
        $this->text = $text;
        $this->userId = $userId;
        $this->created = $created;
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
    public function setTitle(Title $title): void
    {
        $this->title = $title;
    }

    /**
     * @return Id
     */
    public function getArticleId(): Id
    {
        return $this->articleId;
    }

    /**
     * @return Title
     */
    public function getSubtitle(): Title
    {
        return $this->subtitle;
    }

    /**
     * @param mixed $subtitle
     */
    public function setSubtitle(Title $subtitle): void
    {
        $this->subtitle = $subtitle;
    }

    /**
     * @return Text
     */
    public function getText(): Text
    {
        return $this->text;
    }

    /**
     * @param Text $text
     */
    public function setText(Text $text): void
    {
        $this->text = $text;
    }

    /**
     * @return mixed
     */
    public function getUserId()
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

    /**
     * @return array
     */
    public function getAuthorList(): array
    {
        return $this->authorList;
    }

    /**
     * @return array
     */
    public function getPictureList(): array
    {
        return $this->pictureList;
    }

    public function getTeaserPicture()
    {
        return reset($this->pictureList);
    }

    /**
     * @param Author $author
     */
    public function addAuthorToAuthorList(Author $author): void
    {
        $this->authorList[$author->getAuthorId()->toString()] = $author;
    }

    /**
     * @param Author $author
     */
    public function removeAuthorFromAuthorList(Author $author): void
    {
        unset($this->authorList[$author->getAuthorId()->toString()]);
    }

    public function resetAuthorList(): void
    {
        $this->authorList = [];
    }

    /**
     * @param Picture $picture
     */
    public function addPictureToPictureList(Picture $picture): void
    {
        $this->pictureList[$picture->getPictureId()->toString()] = $picture;
    }

    /**
     * @param Picture $picture
     */
    public function removePictureFromPictureList(Picture $picture): void
    {
        unset($this->pictureList[$picture->getPictureId()->toString()]);
    }

    /**
     * resets the picture list
     */
    public function resetPictureList(): void
    {
        $this->pictureList = [];
    }
}