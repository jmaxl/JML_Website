<?php
declare (strict_types=1);

namespace JML\Module\GenericValueObject;

/**
 * Class AbstractDatetime
 * @package JML\Module\GenericValueObject
 */
abstract class AbstractDatetime
{
    const DATE_FORMAT = 'Y-m-d H:i:s';

    /** @var  \DateTime $datetime */
    protected $datetime;

    /**
     * Datetime constructor.
     * @param $datetime
     */
    protected function __construct($datetime)
    {
        $this->datetime = $datetime;
    }

    /**
     * @param $datetime
     * @return AbstractDatetime
     */
    public static function fromValue($datetime)
    {
        self::ensureDatetimeIsValid($datetime);

        $datetime = self::convertDatetime($datetime);

        return new static($datetime);
    }

    /**
     * @param $datetime
     */
    protected static function ensureDatetimeIsValid($datetime): void
    {
        $datetime = strtotime($datetime);

        if ($datetime === false) {
            throw new \InvalidArgumentException('Datetime konnte nicht umgewandelt werden');
        }
    }

    /**
     * @param $datetime
     * @return int
     */
    protected static function convertDatetime($datetime): int
    {
        return strtotime($datetime);
    }

    /**
     * @return string
     */
    abstract public function __toString(): string;

    /**
     * @return string
     */
    abstract public function toString(): string;

    /**
     * @param string $format
     * @return false|string
     */
    public function toDateFormat(string $format)
    {
        return date($format, $this->datetime);
    }

    /**
     * @param Datetime $datetimeInput
     * @return bool
     */
    public function equals(Datetime $datetimeInput): bool
    {
        return ($datetimeInput->toString() === $this->toString());
    }

    /**
     * @return bool
     */
    protected function isPastDatetime(): bool
    {
        return !($this->datetime > time());
    }
}
