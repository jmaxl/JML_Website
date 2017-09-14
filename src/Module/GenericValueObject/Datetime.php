<?php
declare(strict_types=1);

namespace Project\Module\GenericValueObject;


class Datetime extends AbstractDatetime implements DatetimeInterface
{
    const DATETIME_FORMAT = 'Y-m-d H:i';

    const DATE_FORMAT = 'Y-m-d';

    const DATETIME_OUTPUT_FORMAT = 'd.m.Y H:i';

    const DATE_OUTPUT_FORMAT = 'd.m.Y';

    const TIME_FORMAT = 'H:i';

    const WEEKDAY_FORMAT = 'w';

    /**
     * @return string
     */
    public function __toString(): string
    {
        return (string)date(self::DATETIME_OUTPUT_FORMAT, $this->datetime);
    }

    /**
     * @return string
     */
    public function toString(): string
    {
        return (string)date(self::DATETIME_FORMAT, $this->datetime);
    }

    /**
     * @return int
     */
    public function getWeekday(): int
    {
        return (int)date(self::WEEKDAY_FORMAT, $this->datetime);
    }

    /**
     * @param $datetime
     * @return AbstractDatetime|DatetimeInterface
     */
    public static function fromValue($datetime)
    {
        return parent::fromValue($datetime);
    }

    public function getDate(): string
    {
        return (string)date(self::DATE_FORMAT, $this->datetime);
    }

    public function getDateString(): string
    {
        return (string)date(self::DATE_OUTPUT_FORMAT, $this->datetime);
    }

    public function getTimeString(): string
    {
        return (string)date(self::TIME_FORMAT, $this->datetime);
    }
}