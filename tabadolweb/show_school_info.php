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


if (isset($_SESSION['permission']))
{

    
  
        
        $query = $con->query("select * from schools,ev_types.school_dev_data where schools.id=school_dev_data.school_id and school_dev_data.dev_types_id=dev_types.id and schools.id= ".$_GET["id"]);

        $count = mysqli_num_rows($query);
        echo "<table border='1px'>";
        echo "<tr>";
        echo "<th>اسم القطعة</th>";
        echo "<th>النوع</th>";
        echo "<th>ملاحظات</th>";
      
        echo "</tr>";

        while ($result = $query->fetch_assoc())
        {
            echo "<tr>";
            echo "<td>" . $result["name"] . "</td>";
            echo "<td>" . $result["quantity"] . "</td>";
            echo "<td>" . $result["notes"] . "</td>";
            
       
            echo "</tr>";
        }
        echo "</table>";


 
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