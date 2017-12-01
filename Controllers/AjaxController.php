<?php
require_once MODELS . 'Markers.php';

class AjaxController extends Controller
{
    public function mapInsertAction()
    {
        $marc = new Markers();
        $marc->createMarcer($_POST);

    }

    public function mapGetAction()
    {
        $marc = new Markers();
        $_SESSION['map'] = $marc->getMarcer();
        $arr = json_encode($marc->getMarcer());
        echo $arr;
    }


}