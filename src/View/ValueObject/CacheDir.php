<?php
declare (strict_types=1);

namespace JML\View\ValueObject;

/**
 * Class CacheDir
 * @package JML\View\ValueObject
 */
class CacheDir
{
    /** @var string $cacheDir */
    protected $cacheDir;

    /**
     * CacheDir constructor.
     * @param string $templateDir
     */
    protected function __construct(string $templateDir)
    {
        $this->cacheDir = $templateDir;
    }

    /**
     * @param string $templateDir
     * @return CacheDir
     */
    public static function fromString(string $templateDir): self
    {
        self::ensureValueIsValid($templateDir);
        $templateDir = self::convertValue($templateDir);

        self::ensureCacheDirIsValidDir($templateDir);

        return new self($templateDir);
    }

    /**
     * @param string $templateDir
     * @throws \Exception
     */
    protected static function ensureValueIsValid(string $templateDir): void
    {
        if (strlen($templateDir) < 3) {
            throw new \Exception('this cache dir is too short ... minimum three chars');
        }
    }

    /**
     * @param string $templateDir
     * @return string
     */
    protected static function convertValue(string $templateDir): string
    {
        $tempDir = rtrim($templateDir, '/') . '/';

        return ROOT_PATH . $tempDir;
    }

    /**
     * @param string $templateDir
     * @throws \Exception
     */
    protected static function ensureCacheDirIsValidDir(string $templateDir): void
    {
        if (is_dir($templateDir) === false) {
            throw new \Exception('this Cache dir is no valid dir ... it does not exists.');
        }
    }

    /**
     * @return string
     */
    public function getCacheDir(): string
    {
        return $this->cacheDir;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->cacheDir;
    }
}