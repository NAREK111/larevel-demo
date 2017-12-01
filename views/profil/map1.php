<?php
//dd( $_SESSION['user_id']);
if (!isset($_SESSION['user_id'])) {
    throw new Exception('open your profile by link', 404);
}
/*AIzaSyBOOMILXjozOEelGyNOw03Or8xLw9MyDNA*/
?>
<!DOCTYPE html>
<html>
<head>
    <style>
        #map {
            margin: 10px auto;
            height: 400px;
            width: 800px;
        }
    </style>
</head>
<body>
<h3>My Google Maps Demo</h3>
<div id="map"></div>
<script>
    function initMap() {
        var element = document.getElementById('map');
        var uluru ={lat: 50.1535684, lng: 44.3484806}
        var options = {
            zoom: 8,
            center: uluru
        }

        var myMap = new google.maps.Map(element, options);

        var marker = new google.maps.Marker({
            position: uluru,
            map: myMap
        });

        var html ="<table>" +
            "<tr><td>Наименование:</td> <td><input type='text' id='name'/> </td> </tr>" +
            "<tr><td>Адрес:</td> <td><input type='text' id='address'/></td> </tr>" +
            "</select> </td></tr>" +
            "<tr><td></td><td><input type='button' value='Сохранить' onclick='saveData()'/></td></tr></form>";


        var InfoWindow = new  google.maps.InfoWindow({
            content: html
        })


        marker.addListener('click' , function () {
            InfoWindow.open(myMap,marker);
        })
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
                url: '/ajax/map',
                method: 'post',
                dataType: 'json',
                data: data,
                success: function (response) {
                    console.log(response);
                }
            })

        }
    }
</script>
<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBOOMILXjozOEelGyNOw03Or8xLw9MyDNA&callback=initMap">
</script>
</body>
</html>









