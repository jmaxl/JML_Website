<?php
declare(strict_types=1);

namespace Project\Module\GenericValueObject;

class Text
{
    const MIN_TEXT_LENGTH = 50;

    protected $text;

    protected function __construct(string $text)
    {
        $this->text = $text;
    }

    public static function fromString(string $text): self
    {
        self::ensureTextIsValid($text);
        $text = self::convertText($text);

        return new self($text);
    }

    protected static function ensureTextIsValid(string $text): void
    {
        if (strlen($text) < self::MIN_TEXT_LENGTH) {
            throw new \InvalidArgumentException('The text is not long enough.', 1);
        }
    }

    protected static function convertText(string $text): string
    {
        return trim($text);
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function __toString(): string
    {
        return $this->text;
    }
}

