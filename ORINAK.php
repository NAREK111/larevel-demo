<?php
require_once '../Config/constants.php';
require_once 'Controller.php';
require_once 'Model.php';

class App extends Controller
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
        self::$myControllerName = $uriController;

        $uriFileController = CONTROLLER . ucfirst($uriController) . 'Controller.php';

        if (!file_exists($uriFileController)) {
            throw new Exception(CONTROLLER . ucfirst($uriController) . ' is not found', 404);
        }

/////////////////////////////////////////////////////////////////////////////////
/// gtnel controller@ ev inqlud anel aystex // includ '$uriFileController'
/// /////////////////////////////////////////////////////////////////////////////
        class ՎորեվեController extends Controller
        {
            public function ՄետոդAction()
            {
///////////////////////////////////////////////////////////////////////////////
/// action um kancher render funkcian vor@ patasxanatu e anhrajesht viewn gtnelu hamar //////////
/// /////////////////////////////////////////////////////////////////////////////
                //  $this->render('index');
                //tender i mijocov kanchum enq viewn
                public
                function render($view, $params = [])
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
//gtnum enq anhrajesht kontent@ vor@ patqe nerdrvi himnakan karkasi mej //////
                    /*  ob_clean();
                      require_once VIEW.LAYOUTS.$this->layout.'.php';
                      $content = ob_get_contents();*/
                    $content = include 'views/index/index.php'
///////////////////////////////////////////////////////////////////////////////////////////////////
///  inqlud enq anum himnakan karkas@ //////////////////////
                    ?>
                    <!doctype html>
                    <html lang="en">
                    <head>
                        <meta charset="UTF-8">
                        <meta name="viewport"
                              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
                        <meta http-equiv="X-UA-Compatible" content="ie=edge">
                        <title>Main</title>
                        <link rel="stylesheet"
                              href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
                        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
                        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
                    </head>
                    <body>
                    <nav class="navbar navbar-inverse" style="border-radius: 0px">
                        <div class="container-fluid">
                            <div class="navbar-header">
                                <a class="navbar-brand" href="#">WebSiteName</a>
                            </div>
                            <ul class="nav navbar-nav">
                                <li class="active"><a href="#">Home</a></li>
                                <li><a href="#">Page 1</a></li>
                                <li><a href="#">Page 2</a></li>
                            </ul>

                            <ul class="nav navbar-nav navbar-right">
                                <li><a href="/register/index"><span class="glyphicon glyphicon-user"></span> Sign Up</a>
                                </li>
                                <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
                            </ul>
                        </div>
                    </nav>
                    <!-- $content popoxakani poxaren inqlud klini tvyal eji kontent@
                    --> <?php $content ?>

                    </body>
                    </html>

                <? }


            }


        }

/////////////////////////////////////////////////////////////////////////////////
        $controllerName = ucfirst($uriController) . 'Controller';

        if (!class_exists($controllerName)) {
            throw new Exception(CONTROLLER . $controllerName . ' is not class', 404);
        }

        $controller = new  $controllerName; // ՎորեվեController();

        if (!method_exists($controller, $uriAction)) {
            throw new Exception($uriAction . ' is not method', 404);
        }
        $controller->$uriAction();//  ՄետոդAction()
    }
}