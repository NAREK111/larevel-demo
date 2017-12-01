<?php
session_start();
require_once '../help/function.php';
require_once '../Config/constants.php';
require_once 'Controller.php';
require_once 'Model.php';

class App
{
    public static function run()
    {
        $uri = $_SERVER['REQUEST_URI'];
        $uriArray = explode('/', $uri);

        $uriController = DEFAULT_CONTROLLER;
        $uriAction = DEFAULT_ACTION . 'Action';

        if (isset($uriArray[1]) && $uriArray[1] != '') {
            $uriController = $uriArray[1];
            if (isset($uriArray[2]) && $uriArray[2] != '') {
                $uriAction = $uriArray[2] . 'Action';
            }
        }
        Controller::$myControllerName = $uriController;

        $uriFileController = CONTROLLER . ucfirst($uriController) . 'Controller.php';

        if (!file_exists($uriFileController)) {
            throw new Exception(CONTROLLER . ucfirst($uriController) . ' is not found', 404);
        }
        include $uriFileController;

        $controllerName = ucfirst($uriController) . 'Controller';
      //  dd($controllerName);

        if (!class_exists($controllerName)) {
            throw new Exception(CONTROLLER . $controllerName . ' is not class', 404);
        }

        $controller = new $controllerName();

        if (!method_exists($controller, $uriAction)) {
            throw new Exception($uriAction . ' is not method', 404);
        }
        $controller->$uriAction();
    }
}