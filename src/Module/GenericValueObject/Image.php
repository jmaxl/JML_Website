<?php
declare (strict_types=1);

namespace JML\Module\GenericValueObject;

use claviska\SimpleImage;

/**
 * Class Image
 * @package JML\Module\GenericValueObject
 */
class Image
{
    public const PATH = 'data/image/';

    public const TYPE_JPG = 'jpg';
    public const TYPE_PNG = 'png';

    protected const SAVE_QUALITY = 100;
    protected const MAX_LENGTH = 1200;
    protected const MAX_UNCOMPRESSED_FILE_SIZE = 100000;

    /** @var string $imagePath */
    protected $imagePath;

    protected $image;

    /**
     * Image constructor.
     * @param string $path
     */
    protected function __construct(string $path)
    {
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
     * @param array $uploadedFile
     * @param string $path
     * @return null|Image
     */
    public static function fromUploadWithSave(array $uploadedFile): ?self
    {
        $image = self::fromFile($uploadedFile['tmp_name']);

        $simpleImage = new SimpleImage($uploadedFile['tmp_name']);

        $filePath = self::PATH . Filename::generateFilename(Filename::TYPE_IMAGE_MAPPING[$uploadedFile['type']]);

        $simpleImage->toFile($filePath, null, self::SAVE_QUALITY);

        $image->setImagePath($filePath);

        return $image;
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

    /**
     * @return SimpleImage
     */
    public function getImage(): SimpleImage
    {
        return $this->image;
    }

    /**
     * @param string $path
     * @return bool
     * @throws \Exception
     */
    public function saveToPath(string $path): bool
    {
        try {
            $this->image->toFile($path, null, self::SAVE_QUALITY);
        } catch (\InvalidArgumentException $error) {
            return false;
        }

        $this->imagePath = $path;

        return true;
    }

    /**
     * @param string $imagePath
     */
    public function setImagePath(string $imagePath)
    {
        $this->imagePath = $imagePath;
    }
}