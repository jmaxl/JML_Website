<?php
declare(strict_types=1);

namespace Project\Module\GenericValueObject;

class Description
{
    protected $description;

    protected function __construct(string $description)
    {
        $this->description = $description;
    }

    public static function fromString(string $description): self
    {
        self::ensureDescriptionIsValid($description);
        $description = self::convertDescription($description);

        return new self($description);
    }

    protected static function ensureDescriptionIsValid(string $description): void
    {
        if (strlen($description) < 2) {
            throw new \InvalidArgumentException('The description is not long enough.', 1);
        }
    }

    protected static function convertDescription(string $description): string
    {
        return trim($description);
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function __toString(): string
    {
        return $this->description;
    }
}

