<?php
declare(strict_types=1);

namespace Project\View\ValueObject;


class TemplateDir
{
    protected $templateDir;

    protected function __construct(string $templateDir)
    {
        $this->templateDir = $templateDir;
    }

    public static function fromString(string $templateDir): self
    {
        self::ensureValueIsValid($templateDir);
        $templateDir = self::convertValue($templateDir);

        self::ensureTemplateDirExists($templateDir);

        return new self($templateDir);
    }

    protected static function ensureValueIsValid(string $templateDir): void
    {
        if (strlen($templateDir) < 3) {
            throw new \Exception('this template dir is too short ... minimum three chars');
        }
    }

    protected static function convertValue(string $templateDir): string
    {
        $tempDir = rtrim($templateDir, '/') . '/';

        return ROOT_PATH . '/templates' . $tempDir;
    }

    protected static function ensureTemplateDirExists(string $templateDir): void
    {
        if (is_dir($templateDir) === false) {
            throw new \Exception('this template dir is no valid dir ... it does not exists.');
        }
    }

    public function getTemplateDir(): string
    {
        return $this->templateDir;
    }

    public function __toString()
    {
        return $this->templateDir;
    }
}