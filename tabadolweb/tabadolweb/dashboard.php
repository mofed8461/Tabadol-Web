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
        $query = $con->query("select schools.id as id, schools.name as name, schools.city as city, schools.manager_name as manager_name, schools.phone as phone, schools.school_number as school_number from schools");

        $count = mysqli_num_rows($query);
        echo "<table border='1px'>";
        echo "<tr>";
        echo "<th>تعديل</th>";
        echo "<th>اسم المدرسه</th>";
        echo "<th>المدينه</td>";
        echo "<th>اسم المدير/ه</td>";
        echo "<th>رقم الهاتف</td>";
        echo "<th>رقم المدرسه</td>";
        echo "</tr>";

        while ($result = $query->fetch_assoc())
        {
            echo "<tr>";
            echo "<td><a href='update2.php?id=" . $result["id"] . "'>تعديل</a></td>";
            echo "<td><a href='show_school_info.php?id=" . $result["id"] . "'>" . $result["name"] . "</a></td>";
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

        $query = $con->query("select schools.id as id, schools.name as name, schools.city as city, schools.manager_name as manager_name, schools.phone as phone, schools.school_number as school_number from schools, users where schools.id = users.school_id and users.username = '". $_SESSION["username"] . "'");

        $count = mysqli_num_rows($query);
        echo "<table border='1px'>";
        echo "<tr>";
        echo "<th>تعديل</th>";
        echo "<th>عرض الاجهزه</th>";
        echo "<th>اسم المدرسه</th>";
        echo "<th>المدينه</td>";
        echo "<th>اسم المدير/ه</td>";
        echo "<th>رقم الهاتف</td>";
        echo "<th>رقم المدرسه</td>";
        echo "</tr>";

        $school_id = 0;
        while ($result = $query->fetch_assoc())
        {
            echo "<tr>";
            echo "<td><a href='update2.php?id=" . $result["id"] . "'>تعديل</a></td>";
            echo "<td><a href='show_school_info.php?id=" . $result["id"] . "'>عرض الاجهزه</a></td>";
            $school_id = $result["id"];
            echo "<td>" . $result["name"] . "</td>";
            echo "<td>" . $result["city"] . "</td>";
            echo "<td>" . $result["manager_name"] . "</td>";
            echo "<td>" . $result["phone"] . "</td>";
            echo "<td>" . $result["school_number"] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
        ?>

        <h4>طلبات الاستقراض</h4>
        <br />
        <table border="1px">
            <tr>
                <th>اسم الشخص</th>
                <th>رقم الشخص</th>
                <th>من</th>
                <th>الى</th>
                <th>ملاحظات</th>
                <th>اظهار</th>
            </tr>
            <?php

                $query = $con->query("SELECT * FROM requests where requests.school_id=" . $school_id);
                while ($result = $query->fetch_assoc())
                {
                    ?>
                    <tr>
                        <td><?php echo $result["name"]; ?></td>
                        <td><?php echo $result["phone"]; ?></td>
                        <td><?php echo $result["start_time"]; ?></td>
                        <td><?php echo $result["end_time"]; ?></td>
                        <td><?php echo $result["notes"]; ?></td>
                        <td><a href="request_view.php?id=<?php echo $school_id; ?>&request_id=<?php echo $result["id"]; ?>">اظهار</a></td>

                    </tr>

                    <?php
                }

            ?>
        </table>

        <?php

        echo "<br /><a href='request.php?id=" . $school_id . "'>اضافه طلب استقراض</a><br />";

    }
}
else
{
    echo "<script>window.location = 'index.php';</script>";
}



?>
<a href="logout.php">تسجيل الخروج</a>
</div>
</div>
</body>
</html>