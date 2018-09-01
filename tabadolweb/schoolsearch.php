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
    </style>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Dashboard</title>
</head>
<body>
<div align="center" style="padding-top: 10%">
    <div align="center">
        <?php
$text = $_POST["search1"];
            $query = $con->query("SELECT * FROM schools where school_number like '%$text%' or name like '%$text%'") or die($con->error);
            $count = mysqli_num_rows($query);
            echo "<table border='1px'>";
            echo "<tr>";
            echo "<th>تعديل</th>";
            echo "<th>اسم المدرسه</th>";
            echo "<th>اسم المدير/ة</th>";
            echo "<th>رقم الهاتف</th>";
            echo "<th>العنوان</th>";
            echo "<th>البريد الالكتروني</th>";
            echo "<th>رقم المدرسه</th>";
            echo "<th>المدينه</th>";
            echo "<th>الخريطه</th>";
            echo "<th>من الصف</th>";
            echo "<th>الي الصف</th>";
            echo "</tr>";
            while ($result = $query->fetch_assoc())
            {
                echo "<tr>";
                echo "<td><a href='update2.php?id=" . $result["id"] . "'>تعديل</a></td>";
                echo "<td><a href='show_school_info.php?id=" . $result["id"] . "'>" . $result["name"] . "</a></td>";
                echo "<td>" . $result["manager_name"] . "</td>";
                echo "<td>" . $result["phone"] . "</td>";
                echo "<td>" . $result["address"] . "</td>";
                echo "<td>" . $result["email"] . "</td>";
                echo "<td>" . $result["school_number"] . "</td>";
                echo "<td>" . $result["city"] . "</td>";
                echo "<td><a href='https://www.google.com/maps/@" . $result["location_lat"] . "," . $result["location_lng"] . ",15.78z' >الخريطه</a></td>";
                echo "<td>" . $result["grade_from"] . "</td>";
                echo "<td>" . $result["grade_to"] . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        if (false &&isset($_SESSION["redirectURL"]))
        {
            ?>
            <a href="<?php echo $_SESSION["redirectURL"]; ?>">عوده</a>
            <?php
        }
        else
        {
            ?>
            <a href="dashboard.php">عوده</a>
            <?php
        }
        ?>
    </div>
</div>
</body>
</html>