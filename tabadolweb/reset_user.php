
<?php
include("connect.php");

$con->query("UPDATE users SET password=username WHERE id=" . $_GET["id"]) or die("Error in inserting data");


echo "<h2 align='center'>تم التعديل</h2>";

?>
<script language="javascript">
    setTimeout("window.location='users.php'",'3000');
</script>
