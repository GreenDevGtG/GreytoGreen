<?php

namespace Aston\Http;

class Response
{
    /**
     * @var int
     */
    private $statusCode;

    /**
     * @var array
     */
    private $headers = [];

    /**
     * @var mixed
     */
    private $body;

    /**
     * Response constructor.
     *
     * @param null $body
     * @param int $statusCode
     */
    public function __construct($body = null, $statusCode = 200)
    {
        $this->setBody($body)->setStatusCode($statusCode);
    }

    /**
     * @return int
     */
    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    /**
     * @param int $statusCode
     * @return Response
     */
    public function setStatusCode(int $statusCode): Response
    {
        $this->statusCode = $statusCode;
        return $this;
    }

    /**
     * @param $body
     * @return Response
     */
    public function setBody($body): Response
    {
        $this->body = $body;
        return $this;
    }

    /**
     * @return mixed
     */
    protected function getBody()
    {
        return $this->body;
    }

    /**
     * @param string $key
     * @param string $value
     * @return Response
     */
    public function setHeader(string $key, string $value): Response
    {
        //$this->headers['Location'] = 'https://google.com/';
        $this->headers[$key] = $value;
        return $this;
    }

    /**
     * @return array
     */
    public function getHeaders(): array
    {
        return $this->headers;
    }

    /**
     * @param string $url
     * @param int $statusCode
     * @return Response
     */
    public function redirect(string $url, $statusCode = 302): Response
    {
        $this->setStatusCode($statusCode);
        $this->setHeader('Location', $url);
        return $this;
    }

    /**
     * @return mixed
     */
    public function generate()
    {
        http_response_code($this->getStatusCode());

        foreach ($this->getHeaders() as $key => $value) {
            header(sprintf('%s: %s', $key, $value));
        }

        return $this->getBody();
    }
}