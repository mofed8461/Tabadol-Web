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


if (isset($_GET["dev_id"]))
{

    
  
        
        $query = $con->query("SELECT * FROM dev_types where dev_types.id=" . $_GET["dev_id"]) or die($con->error);

        $count = mysqli_num_rows($query);
        echo "<table border='1px'>";
        echo "<tr>";
        echo "<th>اسم القطعة</th>";
        echo "<th>الكود</th>";
        echo "<th>الصوره</th>";
        echo "</tr>";

        while ($result = $query->fetch_assoc())
        {
            echo "<tr>";
            echo "<td>" . $result["name"] . "</td>";
            echo "<td>" . $result["code"] . "</td>";
            echo "<td><img src='" . $result["img"] . "' /></td>";
            echo "</tr>";
        }
        echo "</table>";


 
}
else
{
    echo "<script>window.location = 'index.php';</script>";
}

if (isset($_SESSION["redirectURL"]))
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