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
use Project\Module\GenericValueObject\Datetime;
use Project\Module\GenericValueObject\Text;

class Article
{
    protected $articleId;
    protected §title;
    protected $subtitle;
    protected $text;
    protected $userId;
    protected $created;

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