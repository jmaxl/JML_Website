<?php
declare(strict_types=1);

namespace Project\Module\GenericValueObject;

class Seats
{
    const SEATS_MIN = 1;

    protected $seats;

    protected function __construct(int $seats)
    {
        $this->seats = $seats;
    }

    public static function fromValue(int $seats): self
    {
        self::ensureSeatsIsValid($seats);

        return new self($seats);
    }

    protected static function ensureSeatsIsValid($seats): void
    {
        if ($seats < self::SEATS_MIN) {
            throw new \Exception('Too few seats chosen.', 1);
        }
    }

    public function getSeats(): int
    {
        return $this->seats;
    }

    public function __toString(): string
    {
        return (string) $this->seats;
    }
}
