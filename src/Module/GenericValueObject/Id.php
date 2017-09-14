<?php
declare(strict_types = 1);

namespace Project\Module\GenericValueObject;

use Ramsey\Uuid\Uuid;

class Id
{
    /** @var Uuid $id */
    protected $id;

    public static function generateId(): self
    {
        /** @var Uuid $uuId */
        $uuId = Uuid::uuid4();

        self::ensureValueIsValid($uuId);

        return new self($uuId);
    }

    public static function fromString(string $id): self
    {
        $uuId = Uuid::fromString($id);

        self::ensureValueIsValid($uuId);

        return new self($uuId);
    }

    protected function __construct($id)
    {
        $this->id = $id;
    }

    protected static function ensureValueIsValid($uuId): void
    {
        if (Uuid::isValid($uuId) === false) {
            throw new \InvalidArgumentException('This value is not valid $uuId');
        }
    }

    public function getId(): Uuid
    {
        return $this->id;
    }

    public function eval(Uuid $evalUuId): bool
    {
        return ($evalUuId === $this->id);
    }

    public function __toString(): string
    {
        return (string) $this->id;
    }

    public function toString(): string
    {
        return (string) $this->id;
    }
}