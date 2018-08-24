<?php
session_start();
include "connect.php";


if (isset($_GET['id']) && isset($_GET['request_id']))
{



	$lat=0;
	$lng=0;
	$query = $con->query("SELECT * FROM schools WHERE id=" . $_GET['id']);

	while ($result = $query->fetch_assoc())
	{
		$lat = $result["location_lat"];
		$lng = $result["location_lng"];
	}


    $query = $con->query("SELECT * FROM schools WHERE id NOT IN(" . $_GET['id'] . ")");

    $cnt = 0;
	while ($result = $query->fetch_assoc())
	{
		$lat2 = $result["location_lat"];
		$lng2 = $result["location_lng"];

		$R = 6378137; // Earth’s mean radius in meter
		$dLat = deg2rad($lat2 - $lat);
		$dLong = deg2rad($lng2 - $lng);
		$a = sin($dLat / 2) * sin($dLat / 2) + cos(deg2rad($lat)) * cos(deg2rad($lat2)) * sin($dLong / 2) * sin($dLong / 2);
		$c = 2 * atan2(sqrt($a), sqrt(1 - $a));
		$d = $R * $c;
		// returns the distance in meter

		if ($d < $_GET['dst'])
		{
			
			$msg = "
			<html>
			<head>
			<title>HTML email</title>
			</head>
			<body>
				<a href='show_invitation.php?id=" . $_GET["id"] . "&id2=" . $result["id"] . "&request_id=" . $_GET["request_id"] . "'>اظهار الدعوة</a>
			</body>
			</html>
			";


			$headers = "MIME-Version: 1.0" . "\r\n";
			$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

			// More headers
			$headers .= 'From: <webmaster@example.com>' . "\r\n";


			if (mail($result["email"],"طلب استقراض من حضرتكم", $msg, $headers) === TRUE)
			{
				echo "success";
			}
			else
			{
				echo "fail";
			}


		}

	}






    $con->query("UPDATE requests SET req_code='published' WHERE id=" . $_GET['request_id']);

    //header('Location: request_view.php?id=' . $_GET['id'] . '&request_id=' . $_GET['request_id']);


/*
    var rad = function(x) {
	  return x * Math.PI / 180;
	};

	var getDistance = function(p1, p2) {
	  var R = 6378137; // Earth’s mean radius in meter
	  var dLat = rad(p2.lat() - p1.lat());
	  var dLong = rad(p2.lng() - p1.lng());
	  var a = Math.sin(dLat / 2) * Math.sin(dLat / 2) +
	    Math.cos(rad(p1.lat())) * Math.cos(rad(p2.lat())) *
	    Math.sin(dLong / 2) * Math.sin(dLong / 2);
	  var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
	  var d = R * c;
	  return d; // returns the distance in meter
	};*/




}
else
{
    header('Location: dashboard.php');
}
?>