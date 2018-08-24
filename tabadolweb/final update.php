
<?php
$school_name  = $_POST["school_name"];
$manager_name = $_POST["manager_name"];
$phone        = $_POST["phone"];
$location_lat = $_POST["location_lat"];
$location_lng = $_POST["location_lng"];
$school_number= $_POST["school_number"];
$city         = $_POST["city"];
$address      = $_POST["address"];
$id = $_POST["id"];


include("connect.php");

$con ->query("update schools  set  name='$school_name',phone='$phone',manager_name='$manager_name',location_lat='$location_lat',location_lng='$location_lng',
school_number='$school_number',city='$city',address='$address' where id = '$id'") or die("Error in updating data");
echo "<h2 align='center'>تم تعديل معلومات المدرسة ....</h2>";

?>
<script language="javascript">
    setTimeout("window.location='update school.php'",'3000');
</script>
