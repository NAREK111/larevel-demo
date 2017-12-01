<?php
require_once MODELS . "Markers.php";

class TestController extends Controller
{
    public function testAction()
    {
        $this->insert($_POST);

        /*$dom = new domDocument();
        $dom->formatOutput = true;
        $dom->load(XML, LIBXML_NOBLANKS);
        $root = $dom->documentElement;


        $temp = $dom->getElementsByTagName('user');
        $lastItem = ($temp->length) - 1;
        $lastItemId = $root->getElementsByTagName('user')->item($lastItem)->getAttribute('id');
        var_dump($lastItemId);*/
        function changeAvatar($avatar, $user_id)
        {
            $xml = new DOMDocument();
            $xml->formatOutput = true;
            $xml->load("users.xml", LIBXML_NOBLANKS);
            $root = $xml->documentElement;

            $i = 0;
            foreach ($root->getElementsByTagName('user') as $user) {
                if ($root->getElementsByTagName('user')->item($i)->firstChild->nodeValue == $user_id) {
                    //item(6) is avatar in user
                    $root->getElementsByTagName('user')->item($i)->childNodes->item(6)->nodeValue = $avatar;
                    $xml->save('users.xml');
                    break;
                }
                $i++;
            }
        }
        //  var_dump( $root->tagName);


    }


    public function objectXml()
    {
        $dom = new domDocument(); // Создаём XML-документ версии 1.0 с кодировкой utf-8
        // $dom->formatOutput = true;
        $dom->load(XML);

        return $root = $dom->documentElement;
    }



}