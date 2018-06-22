<?php

namespace Aston\Http;

class Router
{
    /**
     * @var array
     */
    private $routes = [];

    /**
     * @var Request
     */
    private $request;

    /**
     * @var Response
     */
    private $response;

    /**
     * @param Route $route
     * @return Router
     */
    public function setRoute(Route $route): Router
    {
        $this->routes[$route->getPattern()] = $route;
        return $this;
    }

    /**
     * @return array
     */
    public function getRoutes(): array
    {
        return $this->routes;
    }

    /**
     * @param array $routes
     * @return Router
     */
    public function setRoutes(array $routes): Router
    {
        foreach ($routes as $route) {
            $this->setRoute($route);
        }
        return $this;
    }

    /**
     * @return Request
     */
    public function getRequest(): Request
    {
        return $this->request;
    }

    /**
     * @param Request $request
     * @return Router
     */
    public function setRequest(Request $request): Router
    {
        $this->request = $request;
        return $this;
    }

    /**
     * @return Response
     */
    public function getResponse(): Response
    {
        return $this->response;
    }

    /**
     * @param Response $response
     * @return Router
     */
    public function setResponse(Response $response): Router
    {
        $this->response = $response;
        return $this;
    }

    public function match()
    {
        $request = $this->getRequest();
        $uri = $request->getUri();
        $method = $request->getMethod();
        $matches = [];

        foreach ($this->getRoutes() as $pattern => $route) {
            if (preg_match('#^'.$pattern.'$#', $uri, $matches) && $route->hasMethod($method)) {
                array_shift($matches);
                $request->setVars($matches);

                $action = $route->getAction();
                $action($request, $this->getResponse());
                return $this->getResponse()->generate();
            }
        }
        return false;
    }
}
