<?php
require_once  '../vendor/App.php';
try{
    App::run();
}catch (Exception $e){
    echo $e->getMessage();
}
