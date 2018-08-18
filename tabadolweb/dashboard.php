<?php
session_start();
include "connect.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="UTF-8">
    <style>
        p.normal {
            font-weight: normal;
        }

        p.light {
            font-weight: lighter;
        }

        p.thick {
            font-weight: bold;
        }

        p.thicker {
            font-weight: 900;
        }
    </style>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Dashboard</title>
  
</head>

<body>
<div align="center" style="padding-top: 10%">
<div align="center">

<?php


if (isset($_SESSION['permission']))
{

    if ($_SESSION['permission'] == 1)
    {
        // admin
        $query = $con->query("select * from schools");

        $count = mysqli_num_rows($query);
        echo "<table border='1px'>";
        echo "<tr>";
        echo "<th>اسم المدرسه</th>";
        echo "<th>المدينه</td>";
        echo "<th>اسم المدير/ه</td>";
        echo "<th>رقم الهاتف</td>";
        echo "<th>رقم المدرسه</td>";
        echo "</tr>";

        while ($result = $query->fetch_assoc())
        {
            echo "<tr>";
            echo "<td>" . $result["name"] . "</td>";
            echo "<td>" . $result["city"] . "</td>";
            echo "<td>" . $result["manager_name"] . "</td>";
            echo "<td>" . $result["phone"] . "</td>";
            echo "<td>" . $result["school_number"] . "</td>";
            echo "</tr>";
        }
        echo "</table>";


    }
    else if ($_SESSION['permission'] == 2)
    {
        // normal user

        $query = $con->query("select * from schools, users where schools.id = users.school_id and users.username = '". $_SESSION["username"] . "'");

        $count = mysqli_num_rows($query);
        echo "<table border='1px'>";
        echo "<tr>";
        echo "<th>اسم المدرسه</th>";
        echo "<th>المدينه</td>";
        echo "<th>اسم المدير/ه</td>";
        echo "<th>رقم الهاتف</td>";
        echo "<th>رقم المدرسه</td>";
        echo "</tr>";

        while ($result = $query->fetch_assoc())
        {
            echo "<tr>";
            echo "<td>" . $result["name"] . "</td>";
            echo "<td>" . $result["city"] . "</td>";
            echo "<td>" . $result["manager_name"] . "</td>";
            echo "<td>" . $result["phone"] . "</td>";
            echo "<td>" . $result["school_number"] . "</td>";
            echo "</tr>";
        }
        echo "</table>";

    }
}
else
{
    echo "<script>window.location = 'index.php';</script>";
}



?>
<a href="logout.php">Log out</a>
</div>
</div>
</body>
</html>