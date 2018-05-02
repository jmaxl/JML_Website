<?php
declare (strict_types=1);

namespace JML\Module\GenericValueObject;

/**
 * Class Name
 * @package JML\Module\GenericValueObject
 */
class Name extends DefaultGenericValueObject
{
    const MIN_NAME_LENGTH = 2;

    /** @var string $name */
    protected $name;

    /**
     * Name constructor.
     * @param string $name
     */
    protected function __construct(string $name)
    {
        $this->name = $name;
    }

    /**
     * @param string $name
     * @return Name
     */
    public static function fromString(string $name): self
    {
        self::ensureNameIsValid($name);
        $name = self::convertName($name);

        return new self($name);
    }

    /**
     * @param string $name
     */
    protected static function ensureNameIsValid(string $name): void
    {
        if (strlen($name) < self::MIN_NAME_LENGTH) {
            throw new \InvalidArgumentException('Dieser name ist zu kurz!', 1);
        }
    }

    /**
     * @param string $name
     * @return string
     */
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

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->name;
    }
}

