
<?php
$school_name  = $_POST["school_name"];
$manager_name = $_POST["manager_name"];
$phone        = $_POST["phone"];
$location_lat = $_POST["location_lat"];
$location_lng = $_POST["location_lng"];
$school_number= $_POST["school_number"];
$city         = $_POST["city"];
$address      = $_POST["address"];


include("connect.php");

$con ->query("insert into schools  set  name='$school_name',phone='$phone',manager_name='$manager_name',location_lat='$location_lat',location_lng='$location_lng',
school_number='$school_number',city='$city',address='$address'") or die("Error in inserting data");
echo "<h2 align='center'>Thank you , one School is added</h2>";

?>
<script language="javascript">
    setTimeout("window.location='add school.php'",'3000');
</script>
