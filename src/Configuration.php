<?php
declare (strict_types=1);

namespace JML;

/**
 * Class Configuration
 * @package JML
 */
class Configuration
{
    const CONFIG_PATH = ROOT_PATH . '/config.php';

    /** @var array $configuration */
    protected $configuration;

    /**
     * Configuration constructor.
     */
    public function __construct()
    {
        $this->configuration = include self::CONFIG_PATH;
    }

    /**
     * @return array
     */
    public function getConfiguration(): array
    {
        return $this->configuration;
    }

    /**
     * @param string $name
     * @return mixed
     */
    public function getEntryByName(string $name)
    {
        if (!isset($this->configuration[$name])) {
            throw new \InvalidArgumentException('there has to be a valid config key');
        }

        return $this->configuration[$name];
    }
}