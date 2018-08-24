<?php
session_start();
include "connect.php";


if (isset($_GET['id']) && isset($_GET['request_id']) && isset($_GET['request_data_id']))
{
    $con->query("DELETE FROM request_data WHERE id=" . $_GET['request_data_id']);

    header('Location: request_view.php?id=' . $_GET['id'] . '&request_id=' . $_GET['request_id']);
}
else
{
    header('Location: dashboard.php');
}
?>
