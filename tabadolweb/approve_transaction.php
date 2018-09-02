
<?php
include("connect.php");

$con->query("UPDATE transactions  SET admin_status='approved' WHERE id=" . $_GET["transaction_id"]) or die("Error in inserting data");

?>

<h2 align='center'>تمت الموافقة</h2>
<script language="javascript">
    setTimeout("window.location='dashboard.php'",'2000');
</script>
