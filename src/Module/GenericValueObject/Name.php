<?php
declare(strict_types=1);

namespace Project\Module\GenericValueObject;

class Name
{
    protected $name;

    protected function __construct(string $name)
    {
        $this->name = $name;
    }

    public static function fromString(string $name): self
    {
        self::ensureNameIsValid($name);
        $name = self::convertName($name);

        return new self($name);
    }

    protected static function ensureNameIsValid(string $name): void
    {
        if (strlen($name) < 2) {
            throw new \InvalidArgumentException('Dieser name ist zu kurz!', 1);
        }
    }

    protected static function convertName(string $name): string
    {
        if (strpos($name, '-') >= 0) {
            $names = explode('-', $name);

            foreach ($names as $key => $lastname) {
                $lastname = ucwords(strtolower(trim($lastname)));
                $names[$key] = $lastname;
            }

            $name = implode('-', $names);
        } else {
            $name = ucwords(strtolower(trim($name)));
        }

        return $name;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function __toString(): string
    {
        return $this->name;
    }
}

