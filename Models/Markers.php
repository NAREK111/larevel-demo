<?php

class Markers extends Model
{
    public function createMarcer($array)
    {
        $data = [
            'user_id' => $_SESSION['user_id'],
            'name' => $_POST['name'],
            'lng' => $_POST['lng'],
            'lat' => $_POST['lat'],
         //   'address' => $_POST['address'],
        ];
        $this->insert($data);
    }

    public function getMarcer()
    {
        $arr = [
            'user_id' => $_SESSION['user_id'],
        ];

        $res = mysqli_fetch_all($this->select($arr));
        $resaltArray = [];
        $i = 1;
        foreach ($res as $key => $val) {

            $resaltArray[$i++] = [
                "lat" => $val[1],
                "lng" => $val[2],
                "name" =>  $val[3]
            ];
        }
        // var_dump($res);
        return $resaltArray;
//var_dump(mysqli_fetch_all($this->select( $arr)));
    }

}