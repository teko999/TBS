<?php

class View
{
    protected $data;
    protected $path;

    public function __construct($data = [], $path = null)
    {
        if(!$path)
        {
            $path = self::getDefaultViewPath();
        }
        if(!file_exists($path)){
            throw new Exception('Tepmplate not found' . $path);
        }
        $this->path = $path;
        $this->data = $data;
    }

    public static function getDefaultViewPath()
    {
        $router = App::getRouter();
        if(!$router) {
            return false;
        }
        $controllerDir = $router->getController();
        $templateName = $router->getMethodPrefix() . $router->getAction() . '.html';

        return VIEWS_PATH . DS .   $controllerDir . DS . $templateName;
    }

    public function render()
    {
        $data = $this->data;

        ob_start();
        include($this->path);
        $content = ob_get_clean();

        return $content;
    }
}
