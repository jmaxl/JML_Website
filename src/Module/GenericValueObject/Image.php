<?php
declare (strict_types=1);

namespace JML\Module\GenericValueObject;

use claviska\SimpleImage;

/**
 * @todo test the logic on MAC
 * Class Image
 * @package JML\Module\GenericValueObject
 */
class Image
{
    /** @var SimpleImage $image */
    protected $image;

    /** @var string $imagePath */
    protected $imagePath;

    /**
     * Image constructor.
     * @param string $path
     */
    protected function __construct(string $path)
    {
        $this->image = new SimpleImage($path);
        $this->imagePath = $path;

    }

    /**
     * @param string $path
     * @return Image
     */
    public static function fromFile(string $path): self
    {
        return new self($path);
    }

    /**
     * @return string
     */
    public function toString(): string
    {
        return (string)$this->imagePath;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return (string)$this->imagePath;
    }

    /**
     * @return int
     */
    public function getWidth(): int
    {
        return $this->image->getWidth();
    }
}