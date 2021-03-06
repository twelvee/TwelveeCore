<?php

namespace Core\system\models;

class Route
{
    public string $route;
    public string $method;
    public string $className;
    public string $methodName;
    public array $parameters;

    public function __construct(string $route, string $method, string $className, string $methodName, array $parameters=[])
    {
        $this->route = $route;
        $this->method = $method;
        $this->className = $className;
        $this->methodName = $methodName;
        $this->parameters = $parameters;
    }

    public function getRoute(): string
    {
        return $this->route;
    }

    public function getMethod(): string
    {
        return $this->method;
    }

    public function getClassName(): string
    {
        return $this->className;
    }

    public function getMethodName(): string
    {
        return $this->methodName;
    }

    public function getParameters(): array
    {
        return $this->parameters;
    }
}