<?php
session_start();
include "connect.php";

$query = $con->query("SELECT * FROM news WHERE id=" . $_GET["id"]) or die("Error in inserting data");

$res = $query->fetch_assoc();
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
<h4><?php echo $res["title"]; ?></h4><br />
<?php echo $res["text"]; ?> <br />
<a href="news.php">عوده</a>
</div>
</div>
</body>
</html>