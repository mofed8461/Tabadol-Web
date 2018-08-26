<?php
session_start();
?>

<!DOCTYPE html>
<html>
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
</head>
<body>
<div align="center" style="padding-top: 10%">
<div align="center">
<table border="1px">
<?php
if (isset($_SESSION["permission"]) && $_SESSION["permission"] == 1)
{
?>
<tr><td><a href="add_news.php">اضافه خبر</a></td></tr>
<?php 
}
?>
		

<?php

include("connect.php");

$query = $con->query("SELECT * FROM news ORDER BY id DESC") or die("Error in inserting data");

while ($res = $query->fetch_assoc())
{
?>
<tr>
	<td><a href="view_news.php?id=<?php echo $res["id"]; ?>"><?php echo $res["title"]; ?></a></td>
	<?php 
	if (isset($_SESSION["permission"]) && $_SESSION["permission"] == 1)
	{
	?>
	<td><a href="remove_news.php?id=<?php echo $res["id"]; ?>">حذف</a></td>
	<?php 
	}
	?>
</tr>
<?php
}

?>
</table>
</div>
</div>
</body>
</html>


