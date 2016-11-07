<?php

class App
{
    protected static $router;
    public static $db;

    public static function getRouter()
    {
        return self::$router;
    }

    public static function run($uri)
    {
        $r = self::$router = new Router($uri);

        self::$db = new DB(
            Config::get('db_host'),
            Config::get('db_user'),
            Config::get('db_password'),
            Config::get('db_name')
        );

        Lang::load($r->getLang());

        $controllerClass = ucfirst($r->getController()) . 'Controller';
        $controllerMethod = strtolower($r->getMethodPrefix() . $r->getAction());

        $layout = self::$router->getRoute();
        if($layout == 'admin' && Session::get('role') != 'admin') {
            if($controllerMethod != 'admin_login') {
                Router::redirect('/admin/user/login');
            }
        }

        $controllerObject = new $controllerClass();
        if(method_exists($controllerObject, $controllerMethod))
        {
            $viewPath = $controllerObject->$controllerMethod();
            $viewObject = new View($controllerObject->getData(), $viewPath);

            $content = $viewObject->render();
        }

        $layoutPath = VIEWS_PATH . DS . $layout . '.html';
        $layoutViewObject = new View(compact('content'), $layoutPath);
        echo $layoutViewObject->render();
    }
}
