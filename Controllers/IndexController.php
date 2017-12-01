<?php
require_once MODELS . "Markers.php";

class IndexController extends Controller
{
    public function indexAction()
    {
        $this->render('index');
        if (isset($_POST['database'])) {
            $database = new Markers();
            $database->database = $_POST['database'];
            $_SESSION['database'] = $_POST['database'];

        }
    }


}