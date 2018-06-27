<?php

namespace Aston\Http;

class Route
{
    /**
     * @var string
     */
    private $name = '';

    /**
     * @var string /^[a-z]$/
     */
    private $pattern = '';

    /**
     * @var array
     */
    private $methods = [];

    /**
     * @var mixed
     */
    private $action;

    /**
     * Route constructor.
     *
     * @param string $name
     * @param string $pattern
     * @param array $methods
     */
    public function __construct(string $name, string $pattern, array $methods = ['GET'])
    {
        $this->setName($name)
            ->setPattern($pattern)
            ->setMethods($methods);
    }

    /**
     * @param string $method
     * @return bool
     */
    public function hasMethod(string $method): bool
    {
        return in_array($method, $this->getMethods());
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Route
     */
    public function setName(string $name): Route
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getPattern(): string
    {
        return $this->pattern;
    }

    /**
     * @param string $pattern
     * @return Route
     */
    public function setPattern(string $pattern): Route
    {
        $this->pattern = $pattern;
        return $this;
    }

    /**
     * @return array
     */
    public function getMethods(): array
    {
        return $this->methods;
    }

    /**
     * @param array $methods
     * @return Route
     */
    public function setMethods(array $methods): Route
    {
        $this->methods = $methods;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * @param mixed $action
     * @return Route
     */
    public function setAction($action)
    {
        $this->action = $action;
        return $this;
    }
}