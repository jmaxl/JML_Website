<?php
/**
 * Created by PhpStorm.
 * User: jml
 * Date: 27.09.17
 * Time: 22:44
 */

namespace JML;


use JML\Module\GenericValueObject\Id;
use JML\Module\GenericValueObject\Title;
use JML\Module\GenericValueObject\Text;
use JML\Module\GenericValueObject\Datetime;

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
        $this->userid = $userId;
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
    public function setTitle(Title $title)
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
     * @return mixed
     */
    public function getSubtitle()
    {
        return $this->subtitle;
    }

    /**
     * @param mixed $subtitle
     */
    public function setSubtitle($subtitle)
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
    public function setText(Text $text)
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
}