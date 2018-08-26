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

include("connect.php");

$query = $con->query("SELECT users.id AS id, username, name FROM users, schools WHERE users.school_id=schools.id") or die("Error in inserting data");

while ($res = $query->fetch_assoc())
{
?>
<tr>
	<td><?php echo $res["username"]; ?></td>
    <td><?php echo $res["name"]; ?></td>
	<?php 
	if (isset($_SESSION["permission"]) && $_SESSION["permission"] == 1)
	{
	?>
	<td><a href="remove_user.php?id=<?php echo $res["id"]; ?>">حذف</a></td>
    <td><a href="reset_user.php?id=<?php echo $res["id"]; ?>">استرجاع كلمه المرور</a></td>

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


