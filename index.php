<!DOCTYPE html>
<html>

<head>
    <title>DS Assignment</title>

    <script type="text/javascript" src='https://api.mapbox.com/mapbox-gl-js/v2.3.0/mapbox-gl.js'></script>
    <link href='https://api.mapbox.com/mapbox-gl-js/v2.3.0/mapbox-gl.css' rel='stylesheet' />

</head>
<body>

    <?php
    $username = "root";
    $password = "test";
    $database = "test";
    $mysqli = new mysqli("localhost", $username, $password, $database) or die("Could not connect to DB"+ $mysqli->error);
    $currentTime = date('Y-m-d H:i:s');

    if (!empty($_SERVER['HTTP_CLIENT_IP']))
    {
        $ip_address = $_SERVER['HTTP_CLIENT_IP'];
    }
    //whether ip is from proxy
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
    {
        $ip_address = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    //whether ip is from remote address
    else
    {
        $ip_address = $_SERVER['REMOTE_ADDR'];
    }


    //$details = json_decode(file_get_contents("http://ipinfo.io/{$ip_address}/json"));
    $details = json_decode(file_get_contents('http://www.geoplugin.net/json.gp?ip='.$ip_address));
    //$location= $details->loc;
    $lat=$details->geoplugin_latitude;
    $long=$details->geoplugin_longitude;
    $coordinates=$lat.",".$long."";
    $query2= "INSERT INTO DS (IP_Address, Location, Time_Logged_In) VALUES('$ip_address', '$coordinates', '$currentTime')";

    echo '<center><div align="center" id="map" style="width:400px; height: 300px; height: 300px"></div></center>';

    if ($result = $mysqli->query($query2))

        echo '<table border="2" cellspacing="2" cellpadding="2" align="center">
					<tr>
						<td> <font face="Arial">Ip Address</font> </td>
						<td> <font face="Arial">Location</font> </td>
						<td> <font face="Arial">Time Logged In</font> </td>
					</tr>';

    $query = "SELECT IP_Address,Location,Time_Logged_In FROM DS";
    if ($result = $mysqli->query($query)) {
        while ($row = $result->fetch_assoc()) {
            $field1name = $row["IP_Address"];
            $field2name = $row["Location"];
            $field3name = $row["Time_Logged_In"];

            echo '<tr>
                                    <td>'.$field1name.'</td>
                                    <td>'.$field2name.'</td>
                                    <td>'.$field3name.'</td>
                                </tr>';
        }
        $result->free();
    }
    ?>
    <script type="text/javascript">
			mapboxgl.accessToken = 'pk.eyJ1IjoiYWxva2pwIiwiYSI6ImNrcG1zd3d1NTQ3bjAyb254MHR2Y3hqcXUifQ.7-ESpfG_0_fE8lPPiPHDBA';
            var lat1 ='<?php echo $lat ; ?>';
			var long2 ='<?php echo $long ; ?>';
			var map = new mapboxgl.Map({
			container: 'map', // container ID
				style: 'mapbox://styles/mapbox/streets-v11', // style URL
				center: [long2, lat1], // starting position [lng, lat]
			zoom: 9 // starting zoom
			});

			var marker = new mapboxgl.Marker({
			color: "#FFFFF",
				draggable: true
			}).setLngLat([long2, lat1])
			.addTo(map);
    </script>
</body>

</html>