<?php

namespace Core\system\models;

class Request
{
    protected array $request;
    protected string $method;
    protected int $requestStartTime;
    protected string $url;

    public function __construct()
    {
        $this->request = $_REQUEST;
        $this->method = $_SERVER['REQUEST_METHOD'];
        $this->requestStartTime = $_SERVER['REQUEST_TIME'];
        $this->url = $_SERVER['REQUEST_URI'];
    }

    public function getMethod(): string
    {
        return $this->method;
    }

    public function get(string $key)
    {
        return $this->request[$key];
    }

    public function set(string $key, $value = null)
    {
        $this->request[$key] = $value;
    }

    public function getUrl(): string
    {
        return $this->url;
    }
}