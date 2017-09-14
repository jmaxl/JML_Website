<?php
declare(strict_types=1);

namespace Project\Module\GenericValueObject;

use claviska\SimpleImage;

class Image
{
    /** @var SimpleImage $image */
    protected $image;

    protected $imagePath;

    protected function __construct(string $path)
    {
        $this->image = new SimpleImage($path);
        $this->imagePath = $path;

    }

    public static function fromFile(string $path): self
    {
        return new self($path);
    }

    public function toString(): string
    {
        return (string)$this->imagePath;
    }

    public function __toString(): string
    {
        return (string)$this->imagePath;
    }

    public function getWidth(): int
    {
        return $this->image->getWidth();
    }
}