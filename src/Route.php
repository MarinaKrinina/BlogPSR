<?php
namespace MyBlog;

class Route
{
    public static function start()
    {
        $controllerName = 'article';
        $actionName = 'showAll';
        $url = explode('?', $_SERVER['REQUEST_URI']);
        $url = $url[0];
        $url = explode('/', $url);
        if (!empty($url[1])) {
            $controllerName = $url[1];
        }
        if (!empty($url[2])) {
            $actionName = $url[2];
        }
        $controllerName = 'MyBlog\\Controller\\'.ucfirst($controllerName);
        $controller = new $controllerName();
        if(method_exists($controller, $actionName)) {
          $controller->$actionName();
        }
    }
}
