<?php
if (!isset($_SESSION['user_id'])) {
    throw new Exception('open your profile by link', 404);
}
//var_dump($marcerAll);
?>



<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no"/>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
    <title>API Google Maps v3 добавление меток пользователями и вывод их по категориям</title>
    <script type="text/javascript"
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAk5B_hXhXQ_S6Jj8xh-qc_buguESn4ZM0&callback=initMap"></script>

    <script src="<?php echo  JS ?>jquery.min.js" type="text/javascript"></script>

    <script type="text/javascript">
        // HIN MARKERNERI KORDINATNER
        var map, marker;

       /* window.onload = function () {
            $.ajax({
                url: '/ajax/mapGet',
                method: 'post',
                success: function (response) {
                    var res = response;
                    var element = document.getElementById('map');
                    // alert(res);
                    console.log(res);
                }
            })
        };
*/
        /////NOR MARKER
        function initialize() {


            var myLatlng = new google.maps.LatLng(40.175725518346916, 44.50286865234375);
            var myOptions = {
                zoom: 2,
                center: myLatlng,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            }
            map = new google.maps.Map(document.getElementById("map"), myOptions);

            <?php  foreach ($marcerAll as  $val) {?>

            var uluru = {lat:   <?php echo $val['lat'] ?> , lng:<?php echo $val['lng'] ?> };
            var marke = new google.maps.Marker({
                position: uluru,
                map: map
            });
            <?php  } ?>

            var html = "<table>" +
                "<tr><td>Наименование:</td> <td><input type='text' id='name'/> </td> </tr>" +
                "<tr><td>Адрес:</td> <td><input type='text' id='address'/></td> </tr>" +
                "</select> </td></tr>" +
                "<tr><td></td><td><input type='button' value='Сохранить' onclick='saveData()'/></td></tr></form>";

            infowindow = new google.maps.InfoWindow({
                content: html
            });

            google.maps.event.addListener(map, "click", function (event) {
                marker = new google.maps.Marker({
                    position: event.latLng,
                    map: map
                });
                google.maps.event.addListener(marker, "click", function () {
                    infowindow.open(map, marker);
                });
            });

        }

      function saveData() {
            var name = escape(document.getElementById("name").value);
            var address = escape(document.getElementById("address").value);
            var latlng = marker.getPosition();
            var data = {
                "name": name,
                "address": address,
                "lat": latlng.lat(),
                "lng": latlng.lng()
            };
            $.ajax({
                url: '/ajax/mapInsert',
                method: 'post',
                dataType: 'json',
                data: data,
                success: function (response) {
                    console.log(response);
                }
            })

        }


    </script>

    <style type="text/css" media="screen">
        #map {
            float: left;
            width: 600px;
            height: 400px;
            border: 1px solid #000;
        }
        ul#markerTypes {
            float: left;
            width: 500px;
            list-style: none;
            padding: 0;
        }

        ul#markerTypes li {
            padding: 10px;
        }
        ul#markerTypes li label {
            color: #000;
        }
    </style>

</head>
<body onload="initialize()">
<div id="map"></div>
<div id="message"></div>
</body>
</html>