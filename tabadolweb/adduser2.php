
<?php
$username  = $_POST["username"];
$password = $_POST["password"];
$school_number = $_POST["school_number"];



include("connect.php");

$query = $con->query("SELECT * FROM schools WHERE school_number='$school_number'");
$result = $query->fetch_assoc();

if ($result)
{
	$con->query("INSERT into users  set  username='$username',password='$password',permission=2 , school_id=" . $result["id"]) or die("Error in inserting data");
	echo "<h2 align='center'>تمت اضافه مستخدم</h2>";

}
else
{
	echo "<h2 align='center'>خطأ في الرقم الوطني للمدرسه</h2>";

}



?>
<script language="javascript">
    setTimeout("window.location='dashboard.php'",'3000');
</script>
