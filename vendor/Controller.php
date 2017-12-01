<?php

class Controller
{
    public static $myControllerName;
    public $layout = 'main';



    public function render($view, $params = [])
    {
        if (isset($params)) {
            extract($params);
        }
        $urlArray = explode('/', $view);
        if (count($urlArray) > 1) {
            $urlVendor = VIEW . $view . '.php';
        } else {
            $urlVendor = VIEW . self::$myControllerName . DIRECTORY_SEPARATOR . $view . '.php';
        }

        ob_clean();
        require_once VIEW . LAYOUTS . $this->layout . '.php';
        $content = ob_get_contents();

      // dd($urlVendor);
        require $urlVendor;
    }
    public function redirect($url,$params = []){

        header("location: /$url");
    }
}