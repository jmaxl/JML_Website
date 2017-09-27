<?php
declare(strict_types=1);

namespace JML\View\ValueObject;


class CacheDir
{
    protected $cacheDir;

    protected function __construct(string $templateDir)
    {
        $this->cacheDir = $templateDir;
    }

    public static function fromString(string $templateDir): self
    {
        self::ensureValueIsValid($templateDir);
        $templateDir = self::convertValue($templateDir);

        self::ensureCacheDirIsValidDir($templateDir);

        return new self($templateDir);
    }

    protected static function ensureValueIsValid(string $templateDir): void
    {
        if (strlen($templateDir) < 3) {
            throw new \Exception('this cache dir is too short ... minimum three chars');
        }
    }

    protected static function convertValue(string $templateDir): string
    {
        $tempDir = rtrim($templateDir, '/') . '/';

        return ROOT_PATH . $tempDir;
    }

    protected static function ensureCacheDirIsValidDir(string $templateDir): void
    {
        if (is_dir($templateDir) === false) {
            throw new \Exception('this Cache dir is no valid dir ... it does not exists.');
        }
    }

    public function getCacheDir(): string
    {
        return $this->cacheDir;
    }

    public function __toString()
    {
        return $this->cacheDir;
    }
}