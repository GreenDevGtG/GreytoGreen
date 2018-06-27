<?php

namespace Aston\Http;

class Request
{
    /**
     * @var string
     */
    private $uri;

    /**
     * @var array
     */
    private $vars = [];

    /**
     * @var mixed
     */
    private $rawBody;

    /**
     * Request constructor.
     * @param string|null $uri
     */
    public function __construct(string $uri = null)
    {
        if ($uri == null) {
            $uri = $_SERVER['REQUEST_URI'];
        }
        $this->setUri($uri);
    }

    /**
     * @return string
     */
    public function getUri(): string
    {
        return $this->uri;
    }

    /**
     * @param string $uri
     * @return Request
     */
    public function setUri(string $uri): Request
    {
        $this->uri = $uri;
        return $this;
    }

    /**
     * @return array
     */
    public function getVars(): array
    {
        return $this->vars;
    }

    /**
     * @param int $index
     * @return mixed|null
     */
    public function getVar(int $index)
    {
        return $this->vars[$index] ?? null;
    }

    /**
     * @param array $vars
     * @return Request
     */
    public function setVars(array $vars): Request
    {
        $this->vars = $vars;
        return $this;
    }

    /**
     * @return string (GET, POST, PUT, DELETE, HEADER, ...)
     */
    public function getMethod(): string
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    public function isMethod(string $method): bool
    {
        return $this->getMethod() === $method;
    }

    public function getPost(string $key, $default = null)
    {
        return isset($_POST[$key]) ? $_POST[$key] : $default;
    }

    public function getParam(string $key, $default = null)
    {
        return isset($_GET[$key]) ? $_GET[$key] : $default;
    }

    public function getJSON()
    {
        return json_decode($this->getRawBody());
    }

    public function response()
    {
        return $this->getRawBody();
    }

    /**
     * @return mixed
     */
    public function getRawBody()
    {
        if ($this->rawBody == null) {
            $this->rawBody = file_get_contents('php://input');
        }
        return $this->rawBody;
    }

    /**
     * @param mixed $rawBody
     * @return Request
     */
    public function setRawBody($rawBody)
    {
        $this->rawBody = $rawBody;
        return $this;
    }
}

