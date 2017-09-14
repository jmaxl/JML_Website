<?php
declare(strict_types=1);

namespace Project\Module\GenericValueObject;

class Title
{
    const TITLE_MIN_LENGTH = 5;

    protected $title;

    protected function __construct(string $title)
    {
        $this->title = $title;
    }

    public static function fromString(string $title): self
    {
        self::ensureTitleIsValid($title);
        $title = self::convertTitle($title);

        return new self($title);
    }

    protected static function ensureTitleIsValid(string $title): void
    {
        if (strlen($title) < self::TITLE_MIN_LENGTH) {
            throw new \InvalidArgumentException('The title is too short', 1);
        }
    }

    protected static function convertTitle(string $title): string
    {
        return ucfirst(trim($title));
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function __toString(): string
    {
        return $this->title;
    }
}

