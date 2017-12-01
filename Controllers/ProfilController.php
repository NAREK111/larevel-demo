<?php
require_once MODELS . 'User.php';
require_once MODELS . 'Markers.php';

class ProfilController extends Controller
{
    private $user_id;
    private $firstName;
    private $lastName;
    private $gender;
    private $email;
    private $userInfoAll;

    public function __construct()
    {
        /*  $this->userInfoAll = $_SESSION['userInfoAll'];
          extract($_SESSION['userInfoAll']);
          $this->user_id = $id;
          $this->firstName =$firstName;
          $this->lastName = $lastName;
          $this->gender = $gender;
          $this->email =$email;*/

    }

    public function indexAction()
    {
        $this->render('index', [
            "uaer_id" => $this->user_id,
        ]);

    }

    public function map1Action()
    {
        $this->render('map1', [
            "uaer_id" => $this->user_id,
        ]);
    }

    public function map2Action()
    {
        $marcer = new Markers();
        $marcerAll = $marcer->getMarcer();
        $this->render('map2', [
            "marcerAll" => $marcerAll,
        ]);
    }

    public function uploadAction()
    {
        $this->render('index');

          dd('aaaaaaaaaaaaa');
User::userUpload();
    }
}