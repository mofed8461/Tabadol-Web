
<?php
$username  = $_POST["username"];
$password = $_POST["password"];
$school_number = $_POST["school_number"];



include("connect.php");

$con->query("INSERT into users  set  username='$username',password='$password',permission=2 , school_id = '$school_number'") or die("Error in inserting data");




echo "<h2 align='center'>Thank you , user is added</h2>";

?>
<script language="javascript">
    setTimeout("window.location='dashboard.php'",'3000');
</script>
