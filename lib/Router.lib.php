<?php

class Router
{
    protected $uri;
    protected $controller;
    protected $action;
    protected $params;
    protected $route;
    protected $methodPrefix;
    protected $lang;

    public function __construct($uri)
    {
        $this->uri = urldecode(trim($uri, '/'));
        $routes = Config::get('routes');
        $this->route = Config::get('default_route');
        $this->methodPrefix = is($routes, $this->route);
        $this->lang = Config::get('default_lang');
        $this->controller = Config::get('default_controller');
        $this->action = Config::get('default_action');

        $uriParts = explode('?', $this->uri);

        $path = $uriParts[0];
        $pathParts = explode('/', $path);

        if(count($pathParts))
        {
            $mainItem = extractCLItem($pathParts);
            if(in_array($mainItem, array_keys($routes))) {
                $this->route = $mainItem;
                $this->methodPrefix = is($routes, $this->route);
            } else if(in_array($mainItem, Config::get('langs'))) {
                $this->lang = $mainItem;
            } else {
                array_unshift($pathParts, $mainItem);
            }

            if(current($pathParts)) {
                $this->controller = extractCLItem($pathParts);
            }

            if(current($pathParts)) {
                $this->action = extractCLItem($pathParts);
            }

            $this->params = $pathParts;
        }
    }

    public static function redirect($location)
    {
        header("Location:" . DS . BASE_ROOT . $location);
        exit;
    }

    public function getUri()
    {
        return $this->uri;
    }

    public function getController()
    {
        return $this->controller;
    }

    public function getAction()
    {
        return $this->action;
    }

    public function getParams()
    {
        return $this->params;
    }

    public function getRoute()
    {
        return $this->route;
    }

    public function getMethodPrefix()
    {
        return $this->methodPrefix;
    }

    public function getLang()
    {
        return $this->lang;
    }
}
