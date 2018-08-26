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

        echo "<div> <a href='add%20school.php' > اضافة مدرسة جديدة </a> </div>";
        ?>
        <iframe src="users.php">
            <p>Your browser does not support iframes.</p>
        </iframe>
        <?php
        echo"<div> <a href='adduser.php' > اضافة مستخدم جديد </a> </div>";

        ?>


        <h4>عرض الاستقراضات الحالية</h4>
        <br />
        <table border="1px">
            <tr>
                <th>اسم المدرسه الطالبه</th>
                <th>اسم المدرسه المعطية</th>
                <th>اسم الشخص الطالب</th>
                <th>رقم الشخص الطالب</th>
                <th>اسم الشخص المعطي</th>
                <th>رقم الشخص المعطي</th>
                <th>تاريخ الاقراض</th>
                <th>تاريخ الترجيع</th>
                <th>ملاحظات</th>
                <th>اظهار الطلب</th>
            </tr>
            <?php

                $query = $con->query("
                    SELECT 
                    sc1.id AS school_id,
                    sc1.name AS ask, 
                    sc2.name AS give, 
                    transactions.phone_1 AS p1,
                    transactions.phone_2 AS p2,
                    transactions.name_1 AS n1,
                    transactions.name_2 AS n2,
                    transactions.request_id AS rid,
                    requests.start_time AS st,
                    requests.end_time AS ed,
                    requests.notes AS notes
                    FROM
                    transactions, 
                    schools AS sc1, 
                    schools AS sc2,
                    requests
                    WHERE 
                    transactions.school_1_id=sc1.id AND 
                    transactions.school_2_id=sc2.id AND
                    requests.id=transactions.request_id
                    ");


                while ($result = $query->fetch_assoc())
                {
                    ?>
                    <tr>
                        <td><?php echo $result["ask"]; ?></td>
                        <td><?php echo $result["give"]; ?></td>
                        <td><?php echo $result["n1"]; ?></td>
                        <td><?php echo $result["p1"]; ?></td>
                        <td><?php echo $result["n2"]; ?></td>
                        <td><?php echo $result["p2"]; ?></td>
                        <td><?php echo $result["st"]; ?></td>
                        <td><?php echo $result["ed"]; ?></td>
                        <td><?php echo $result["notes"]; ?></td>
                        <td><a href="request_view.php?id=<?php echo $result["school_id"]; ?>&request_id=<?php echo $result["rid"]; ?>">اظهار</a></td>

                    </tr>

                    <?php
                }

            ?>
        </table>
        <h4>الاخبار</h4>
        <br />
        <iframe src="news.php">
              <p>Your browser does not support iframes.</p>
        </iframe>
        <br />
        <?php


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

                $query = $con->query("SELECT * FROM requests where requests.school_id=" . $school_id . " AND requests.req_code!='completed'");
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

        ?>


        <h4>عرض الاستقراضات الحالية</h4>
        <br />
        <table border="1px">
            <tr>
                <th>اسم المدرسه الطالبه</th>
                <th>اسم المدرسه المعطية</th>
                <th>اسم الشخص الطالب</th>
                <th>رقم الشخص الطالب</th>
                <th>اسم الشخص المعطي</th>
                <th>رقم الشخص المعطي</th>
                <th>تاريخ الاقراض</th>
                <th>تاريخ الترجيع</th>
                <th>ملاحظات</th>
                <th>اظهار الطلب</th>
            </tr>
            <?php

                $query = $con->query("
                    SELECT 
                    sc1.name AS ask, 
                    sc2.name AS give, 
                    sc1.id AS id1, 
                    sc2.id AS id2, 
                    transactions.phone_1 AS p1,
                    transactions.phone_2 AS p2,
                    transactions.name_1 AS n1,
                    transactions.name_2 AS n2,
                    transactions.request_id AS rid,
                    requests.start_time AS st,
                    requests.end_time AS ed,
                    requests.notes AS notes
                    FROM
                    transactions, 
                    schools AS sc1, 
                    schools AS sc2,
                    requests
                    WHERE 
                    transactions.school_1_id=sc1.id AND 
                    transactions.school_2_id=sc2.id AND
                    (sc1.id=" . $school_id . " OR sc2.id=" . $school_id . ") AND
                    requests.id=transactions.request_id
                    ");


                while ($result = $query->fetch_assoc())
                {
                    ?>
                    <tr>
                        <td><a href="view_school_info.php?id=<?php echo $result["id1"]; ?>"><?php echo $result["ask"]; ?></a></td>
                        <td><a href="view_school_info.php?id=<?php echo $result["id2"]; ?>"><?php echo $result["give"]; ?></a></td>
                        <td><?php echo $result["n1"]; ?></td>
                        <td><?php echo $result["p1"]; ?></td>
                        <td><?php echo $result["n2"]; ?></td>
                        <td><?php echo $result["p2"]; ?></td>
                        <td><?php echo $result["st"]; ?></td>
                        <td><?php echo $result["ed"]; ?></td>
                        <td><?php echo $result["notes"]; ?></td>
                        <td><a href="request_view.php?id=<?php echo $school_id; ?>&request_id=<?php echo $result["rid"]; ?>">اظهار</a></td>

                    </tr>

                    <?php
                }

            ?>
        </table>

        <h4>الاخبار<h4>
        <br />

        <iframe src="news.php">
              <p>Your browser does not support iframes.</p>
        </iframe>
        <br />

        <?php

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