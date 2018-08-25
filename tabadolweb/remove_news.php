
<?php
include("connect.php");

$con->query("DELETE FROM news WHERE id=" . $_GET["id"]) or die("Error in inserting data");


echo "<h2 align='center'>تم حذف الخبر</h2>";

?>
<script language="javascript">
    setTimeout("window.location='news.php'",'3000');
</script>
