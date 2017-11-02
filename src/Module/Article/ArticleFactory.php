<?php
declare (strict_types=1);

namespace JML\Module\Article;

use JML\Module\GenericValueObject\Datetime;
use JML\Module\GenericValueObject\Id;
use JML\Module\GenericValueObject\Text;
use JML\Module\GenericValueObject\Title;

/**
 * Class ArticleFactory
 * @package JML\Module\Article
 */
class ArticleFactory
{
    /**
     * @param $result
     * @return Article
     */
    public function getArticle($result): Article
    {
        $articleId = Id::fromString($result->authorId);
        $title = Title::fromString($result->userId);
        $text = Text::fromString($result->text);
        $userId = Id::fromString($result->userId);
        /** @var Datetime $created */
        $created = Datetime::fromValue($result->created);

        $article = new Article($articleId, $title, $text, $userId, $created);

        if ($result->subtitle !== null) {
            $subtitle = Title::fromString($result->subtitle);
            $article->setSubtitle($subtitle);
        }

        return $article;
    }
}