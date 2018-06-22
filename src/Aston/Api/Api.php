<?php

namespace GreenDev;

use Aston\Http\Request;
use Aston\Http\Response\Json as ResponseJson;
use Aston\Http\Router;
use Aston\Http\Route;

class Api
{
    /**
     * @var
     */
    private $router;



    /**
     * Api constructor.
     */
    public function __construct()
    {
        $this->setRouter(new Router());
        $this->getRouter()->setRequest(new Request());
        $this->getRouter()->setResponse(new ResponseJson());
    }


    /**
     * @return mixed
     */
    public function getRouter()
    {
        return $this->router;
    }

    /**
     * @param mixed $router
     * @return Api
     */
    public function setRouter($router)
    {
        $this->router = $router;
        return $this;
    }



    public function get(string $pattern, callable $action)
    {
        $route = $this->createRoute($pattern,$action,['GET']);
        $this->getRouter()->setRoute($route);
    }

    public function post(string $pattern, callable $action)
    {
        $route = $this->createRoute($pattern,$action,['POST']);
        $this->getRouter()->setRoute($route);
    }

    public function put(string $pattern, callable $action)
    {
        $route = $this->createRoute($pattern,$action,['PUT']);
        $this->getRouter()->setRoute($route);
    }

    public function delete(string $pattern, callable $action)
    {
        $route = $this->createRoute($pattern,$action,['DELETE']);
        $this->getRouter()->setRoute($route);
    }

    protected function createRoute(string $pattern, callable $action, array $method)
    {
        $route = new Route('',$pattern,$method);
        $route->setAction($action);
        return $route;
    }
}