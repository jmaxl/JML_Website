<?php
declare (strict_types=1);

namespace JML;

/**
 * Class Routing
 * @package JML
 */
class Routing
{
    const ERROR_ROUTE = 'notfound';

    /** @var array $routeConfiguration */
    protected $routeConfiguration;

    /** @var  string $projectNamespace */
    protected $projectNamespace;

    /** @var  string $controllerNamespace */
    protected $controllerNamespace;

    /** @var Configuration $configuration */
    protected $configuration;

    /**
     * Routing constructor.
     * @param Configuration $configuration
     */
    public function __construct(Configuration $configuration)
    {
        $this->routeConfiguration = $configuration->getEntryByName('route');
        $this->controllerNamespace = $configuration->getEntryByName('controller')['namespace'];
        $this->projectNamespace = $configuration->getEntryByName('project')['namespace'];
        $this->configuration = $configuration;
    }

    /**
     * @param string $route
     */
    public function startRoute(string $route): void
    {
        if (isset($this->routeConfiguration[$route]) === false) {
            if (isset($this->routeConfiguration[self::ERROR_ROUTE]) === false) {
                throw new \InvalidArgumentException('There is no valid Route. Look in the config for mapping.');
            }

            $route = $this->routeConfiguration[self::ERROR_ROUTE];
        } else {
            $route = $this->routeConfiguration[$route];
        }

        $controllerName = $this->projectNamespace . '\\' . $this->controllerNamespace . '\\' . $route['controller'];
        $actionName = $route['action'];

        $controller = new $controllerName($this->configuration);
        $controller->$actionName();
    }
}