
<?php
$school_name  = $_POST["school_name"];
$manager_name = $_POST["manager_name"];
$phone        = $_POST["phone"];
$location_lat = $_POST["location_lat"];
$location_lng = $_POST["location_lng"];
$school_number= $_POST["school_number"];
$city         = $_POST["city"];
$address      = $_POST["address"];
$email        =$_POST["email"];


include("connect.php");

$con->query("INSERT into schools  set  name='$school_name',phone='$phone',manager_name='$manager_name',location_lat='$location_lat',location_lng='$location_lng',
school_number='$school_number',city='$city',address='$address',email='$email'") or die("Error in inserting data");


$school_id = $con->query("SELECT id FROM schools WHERE name='$school_name' AND phone='$phone' AND manager_name='$manager_name' AND location_lat='$location_lat' AND location_lng='$location_lng' AND school_number='$school_number' AND city='$city' AND address='$address' AND email='$email'")->fetch_assoc()["id"];

$con->query("INSERT into users SET username='" . $manager_name . "', password='" . $manager_name . "', permission=2, school_id=" . $school_id);


echo "<h2 align='center'>Thank you , one School is added</h2>";

?>
<script language="javascript">
    setTimeout("window.location='add school.php'",'3000');
</script>
