
<?php
include("connect.php");

$con->query("DELETE FROM users WHERE id=" . $_GET["id"]) or die("Error in inserting data");


echo "<h2 align='center'>تم الحذف</h2>";

?>
<script language="javascript">
    setTimeout("window.location='users.php'",'3000');
</script>
