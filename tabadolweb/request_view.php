<?php
session_start();
include "connect.php";



if (!isset($_GET['id']))
{
    header('Location: dashboard.php');
}



//id=..&phone=..&name=..&start_time=..&end_time=..&notes=..
//id=..&request_id=..

if (!isset($_GET["request_id"]))
{

    $con->query("INSERT INTO requests (school_id, phone, name, start_time, end_time, notes) VALUES ('" . $_GET['id'] . "', '" . $_GET['phone'] . "', '" . $_GET['name'] . "', '" . $_GET['start_time'] . "', '" . $_GET['end_time'] . "', '" . $_GET['notes'] . "')");

    $query = $con->query("SELECT id FROM requests WHERE 
        school_id='" . $_GET['id'] . "' AND 
        phone='" . $_GET['phone'] . "' AND 
        name='" . $_GET['name'] . "' AND 
        start_time='" . $_GET['start_time'] . "' AND 
        end_time='" . $_GET['end_time'] . "' AND 
        notes='" . $_GET['notes'] . "'");

    $result = $query->fetch_assoc();

    $school_id = $_GET["id"];
    $request_id = $result["id"];

    ?>
    <script type="text/javascript">
        window.location = 'request_view.php?id=<?php echo $school_id . "&request_id=" . $request_id; ?>';
    </script>
    <?php
}

$school_id = $_GET["id"];
$request_id = $_GET["request_id"];

$_SESSION["redirectURL"] = "request_view.php?id=" . $_GET["id"] . "&request_id=" . $_GET["request_id"];

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

.dropbtn {
    background-color: #4CAF50;
    color: white;
    padding: 16px;
    font-size: 16px;
    border: none;
    cursor: pointer;
}

.dropbtn:hover, .dropbtn:focus {
    background-color: #3e8e41;
}

#myInput {
    border-box: box-sizing;
    background-image: url('searchicon.png');
    background-position: 14px 12px;
    background-repeat: no-repeat;
    font-size: 16px;
    padding: 14px 20px 12px 45px;
    border: none;
    border-bottom: 1px solid #ddd;
}

#myInput:focus {outline: 3px solid #ddd;}

.dropdown {
    position: relative;
    display: inline-block;
}

.dropdown-content {
    display: none;
    position: absolute;
    background-color: #f6f6f6;
    min-width: 230px;
    overflow: auto;
    border: 1px solid #ddd;
    z-index: 1;
}

.dropdown-content a {
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
}

.dropdown a:hover {background-color: #ddd;}

.show {display: block;}
</style>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Dashboard</title>
</head>

<body>
<div align="center" style="padding-top: 10%">
    <div align="center">
        <h3>اظهار الطلب</h3>
        <br />
        <table border="1px">
            <tr>
                <th>نوع الجهاز</th>
                <th>الكميه المطلوبه</th>
                <th>تعديل</th>
            </tr>
            <?php

                $query = $con->query("
                    SELECT 
                        requests.req_code AS code,
                        request_data.id AS id,
                        dev_types.id AS dev_id, 
                        dev_types.name AS name, 
                        request_data.quantity AS quantity
                        FROM schools, dev_types, request_data, requests
                    WHERE 
                        requests.id=request_data.request_id AND
                        schools.id=requests.school_id AND 
                        request_data.dev_type_id=dev_types.id AND 
                        schools.id=" . $school_id . " AND
                        request_data.request_id=" . $request_id) or die($con->error);

                $done_request = false;
                while ($result = $query->fetch_assoc())
                {
                    ?>
                        <tr>
                            <td><a href='view_device_info.php?dev_id=<?php echo $result["dev_id"]; ?>'><?php echo $result["name"]; ?></a></td>
                            <td><?php echo $result["quantity"]; ?></td>

                            <td>
                            <?php 
                            if ($result["code"] == "")
                            {
                            ?>
                                <a href="remove_request_devices.php?id=<?php echo $school_id; ?>&request_id=<?php echo $request_id; ?>&request_data_id=<?php echo $result["id"]; ?>">حذف</a>
                            <?php
                            }
                            else
                            {
                                $done_request = true;
                                ?>
                                تم ارسال الطلب لا يمكن التعديل
                                <?php
                            }
                            ?>
                            </td>
                        </tr>
                    <?php
                }


            ?>
        </table>
        <?php 
        if (!$done_request)
        {
        ?>
        <a href="add_request_devices.php?request_id=<?php echo $_GET["request_id"]; ?>">اضافه كميه</a>
        <br />
        مسافة البحث
        <br />
        <input id="dst" onchange="dstChanged(this.value);" type="number" min="1" max="3000000" value="1000" />متر 
        <br />
        <span id="dst_info"></span>
        <br />
        <button onclick="publish();">اتمام الطلب</button><br /><b>ملاحظه: لا يمكن تعديل الطلب بعد هذا الخيار و سيتم ارساله للمدارس</b>
        <br />
        <?php
        }
        ?>
        <a href="dashboard.php">عوده</a>
    </div>
</div>
</body>
</html>
<script type="text/javascript">
    function publish()
    {
        window.location="request_done.php?id=<?php echo $school_id; ?>&request_id=<?php echo $_GET["request_id"]; ?>&dst=" + document.getElementById("dst").value;
    }

    function dstChanged(dst)
    {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function()
        {
            if (this.readyState == 4 && this.status == 200)
            {
                document.getElementById("dst_info").innerHTML = this.responseText;
            }
        };
        xhttp.open("GET", "schools_near_me.php?id=<?php echo $school_id; ?>&dst=" + dst, true);
        xhttp.send();
    }
</script>



