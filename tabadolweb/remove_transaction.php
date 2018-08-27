<?php
session_start();
include "connect.php";


if (isset($_GET['id']) && isset($_GET['transaction_id'] && isset($_GET['request_id']))
{

    $con->query("DELETE FROM transactions WHERE transactions.id=" . $_GET['transaction_id']);

    $con->query("DELETE FROM requests WHERE transactions.id=" . $_GET['request_id']);

    header('Location: dashboard.php');
}
else
{
    header('Location: dashboard.php');
}
?>
