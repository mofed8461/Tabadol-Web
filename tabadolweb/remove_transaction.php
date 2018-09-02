<?php
session_start();
include "connect.php";


if (isset($_GET['transaction_id']) && isset($_GET['request_id']))
{

    $con->query("DELETE FROM transactions WHERE transactions.id=" . $_GET['transaction_id']);

    $con->query("DELETE FROM requests WHERE transactions.id=" . $_GET['request_id']);

}
else
{
}
?>

<script type="text/javascript">
	window.location='dashboard.php';
</script>
