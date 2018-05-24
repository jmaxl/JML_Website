<?php
declare (strict_types=1);

namespace JML\Module\Tag;

use InvalidArgumentException;

/**
 * Class TagName
 * @package JML\Module\User
 */
class TagName
{
    /** @var int MAX_LENGTH_TAGNAME */
    protected const MAX_LENGTH_TAGNAME = 50;

    /** @var string $tagName */
    protected $tagName;

    /**
     * TagName constructor.
     * @param string $tagName
     */
    protected function __construct($tagName)
    {
        $this->tagName = $tagName;
    }

    /**
     * @param string $tagName
     * @return TagName
     */
    public static function fromString(string $tagName): self
    {
        self::ensureTagNameIsValid($tagName);

        return new self(self::convertTagName($tagName));
    }

    /**
     * @param string $tagName
     */
    protected static function ensureTagNameIsValid(string $tagName): void
    {
        if (empty($tagName) === true) {
            throw new InvalidArgumentException('Du muss schon etwas reinschreiben!');
        }
        if (strlen($tagName) > self::MAX_LENGTH_TAGNAME) {
            throw new InvalidArgumentException('Dieser Tag ist zu lang.');
        }
        if (ctype_space(trim($tagName)) === true) {
            throw new InvalidArgumentException('Bitte nur ein Wort eingeben!');
        }
    }

    /**
     * @param string $tagName
     * @return string
     */
    protected static function convertTagName(string $tagName): string
    {
        return ucfirst(trim($tagName));
    }

    /**
     * @return string
     */
    public function getTagName(): string
    {
        return $this->tagName;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->getTagName();
    }
}
