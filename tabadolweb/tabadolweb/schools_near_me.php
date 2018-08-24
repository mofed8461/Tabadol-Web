<?php
session_start();
include "connect.php";


if (isset($_GET['id']) && isset($_GET['dst']))
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
			$cnt++;
		}

	}

	if ($cnt >= 2)
	{
		echo "يوجد " . $cnt . " مدارس في هذا المدى";
	}
	else
	{
		echo "يوجد " . $cnt . " مدرسة في هذا المدى";
	}

}
else
{
    header('Location: dashboard.php');
}
?>
