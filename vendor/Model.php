<?php

class Model
{
    public $connect;
    protected $table;
    protected $userAllInfo;
    public $database = MYSQL;

    public function __construct()
    {
        if (!$this->table) {
            $this->table = strtolower(get_class($this));
        }

        $arrayIni = parse_ini_file(CONFIG . 'app.ini', true);
        extract($arrayIni['database']);
        $this->connect = new mysqli($host, $user, $password, $database);


        if (isset($_SESSION['database'])) {
            $this->database = $_SESSION['database'];
        }

    }

    public function insert($array)
    {
        $this->insertMysql($array);
      // $this->insertJson($array);
        // $this->insertXml($array);
    }

    public function select($array)
    {
        //  var_dump($this->database);
        if ($this->database == MYSQL) {
            return $this->selectMysql($array);

        }
        if ($this->database == MY_JSON) {
            //  dd('json');
            return $this->selectJson($array);

        }
        if ($this->database == MY_XML) {
            var_dump(' databas xml not found');

        }
        // return $this->selectMysql($array);
    }


    //////////////////////////////////////   MYSQL FUNCTION //////////////////////////////


    public function insertMysql($array)
    {
        $arrayKey = [];
        $arrayValue = [];
        foreach ($array as $key => $value) {
            $arrayKey[] = "`" . $key . "`";
            $arrayValue[] = "'" . $value . "'";
        }
        $strKey = implode(" , ", $arrayKey);
        $strValue = implode(" , ", $arrayValue);
        $insert = "INSERT INTO $this->table ($strKey) VALUES ($strValue)";
        $this->connect->query($insert);

    }

    public function selectMysql($array)
    {
        //  dd($array);
        $arrayKey = [];
        $arraySelect = [];
        foreach ($array as $key => $value) {
            $arrayKey[] = "`" . $key . "`";
            $arraySelect [] = "`" . $key . "` = '" . $value . "'";
        }

        $strKey = implode(",", $arrayKey);
        $select = implode(" AND ", $arraySelect);

        $sql = "SELECT * FROM  $this->table  WHERE  $select ";
        //  dd($sql);
        $this->connect->query($sql);

        return $this->connect->query($sql);

    }

//////////////////////////////////////////// JSON function   ///////////////////////////////////
    public function insertJson($array)
    {
        $data = file_get_contents(JSON);
        $jsonArray = json_decode($data, true);
        end($jsonArray);
        $key = key($jsonArray) + 1;
        $jsonArray[$key] = $array;
        $jsonArray[$key]['user_id'] = $key;

        file_put_contents(JSON, json_encode($jsonArray));
    }

    public function selectJson($array)
    {
        $jsonAll = $this->getJsonALL();
        $count = count($array);
        foreach ($jsonAll as $key => $val) {
            $error = 0;

            foreach ($array as $keyy => $value)

                if ($val[$keyy] == $value) {
                    $error++;
                    if ($error == $count) {
                        // dd($val);
                        return $val;
                    }
                }
        }
    }

    public function getJsonALL()
    {
        $data = file_get_contents(JSON);
        return json_decode($data, true);
    }

    public function setJson($jsonArray)
    {
        file_put_contents(JSON, json_encode($jsonArray));
    }

    public function getJsonUser($user_id)
    {
        $data = file_get_contents(JSON);
        $jsonArray = json_decode($data, true);
        return $jsonArray['$user_id'];
    }


/////////////////////////////////////////// XML function ////////////////////////////////

    public function insertXml($arr)
    {
        var_dump($arr);
        $array = [
            'firstName' => $arr['firstName'],
            'lastName' => $arr['lastName'],
            'email' => $arr['email'],
            'password' => $arr['password'],
            'gender' => $arr['gender'],
        ];
        extract($array);

        $dom = new domDocument();
        $dom->formatOutput = true;
        $dom->load(XML);
        $root = $dom->documentElement;
        $temp = $dom->getElementsByTagName('user');
        $lastItem = ($temp->length) - 1;
        $lastItemId = $root->getElementsByTagName('user')->item($lastItem)->getAttribute('id');
        $id = $lastItemId + 1; // id-пользователя
        $user = $dom->createElement("user"); // Создаём узел "user"
        $user->setAttribute("id", $id); // Устанавливаем атрибут "id" у узла "user"
        $user_id = $dom->createElement("user_id", $id); // Создаём узел "password" с текстом внутри
        $firstName = $dom->createElement("firstName", $firstName); // Создаём узел "login" с текстом внутри
        $lastName = $dom->createElement("lastName", $lastName); // Создаём узел "password" с текстом внутри
        $gender = $dom->createElement("gender", $gender); // Создаём узел "login" с текстом внутри
        $email = $dom->createElement("email", $email); // Создаём узел "password" с текстом внутри
        $password = $dom->createElement("password", $password); // Создаём узел "password" с текстом внутри

        $user->appendChild($user_id);// Добавляем в узел "user" узел "password"
        $user->appendChild($firstName); // Добавляем в узел "user" узел "login"
        $user->appendChild($lastName); // Добавляем в узел "user" узел "login"
        $user->appendChild($gender); // Добавляем в узел "user" узел "login"
        $user->appendChild($email); // Добавляем в узел "user" узел "login"
        $user->appendChild($password);// Добавляем в узел "user" узел "password"
        $root->appendChild($user); // Добавляем в корневой узел "users" узел "user"
        $dom->save(XML); // Сохраняем полученный XML-документ в файл
    }


    public function changeAvatar($avatar, $user_id)
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
}
