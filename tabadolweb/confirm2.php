<?php
session_start();
include "connect.php";

// confirm2.php?id=2&id2=1&request_id=1&name=ali&phone=0&notes=no%20txt





if (isset($_GET["phone2"]))
{
	// confirm2.php?id=2&id2=1&request_id=1&name=ahmad&phone=333&name2=ali&phone2=0&notes=no%20txt

	$email_query = $con->query("SELECT id, email FROM schools WHERE id=" . $_GET["id"] . " OR id=" . $_GET["id2"]);

	

	$query = $con->query("
		INSERT INTO transactions(
		school_1_id, 
		school_2_id, 
		phone_1, 
		phone_2, 
		name_1, 
		name_2, 
		request_id,
		admin_status) 
		VALUES (
		'" . $_GET["id"] . "',
		'" . $_GET["id2"] . "',
		'" . $_GET["phone"] . "',
		'" . $_GET["phone2"] . "',
		'" . $_GET["name"] . "',
		'" . $_GET["name2"] . "',
		'" . $_GET["request_id"] . "', '')");

	$con->query("UPDATE requests SET req_code='completed' WHERE id=" . $_GET["request_id"]);


	while ($result = $email_query->fetch_assoc())
	{
		$msg = "
				<html>
				<head>
				<title>HTML email</title>
				</head>
				<body>
					<a href='http://" . dirname($_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI']) . "/dashboard.php'>تم الاتفاق على طلب الاقراض يمكنك رؤويه العملية اضغط هنا</a>
				</body>
				</html>
				";



		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

		// More headers
		$headers .= 'From: <webmaster@example.com>' . "\r\n";


		if (mail($result["email"],"طلب استقراض من حضرتكم", $msg, $headers) === TRUE)
		{
			echo "success";
		}
		else
		{
			echo "fail";
		}
	}

}
else
{
	$query2 = $con->query("SELECT * FROM requests WHERE id=" . $_GET['request_id']);
	$result2 = $query2->fetch_assoc();

	if ($result2 == NULL || $result2["req_code"] == "completed")
	{
		header("Location: invitation_ended.php");
	}
}

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
    <title>دعوة استقراض</title>
  
</head>

<body>
<div align="center" style="padding-top: 10%">
	<div align="center">

		<?php 

		if (!isset($_GET["phone2"]))
		{
		?>

		لاتمام الاتفاق يرجى تعبئة البيانات التالية<br />
		اسم الشخص <input id="name" type="text" /><br />
		رقم الهاتف<input id="phone" type="text" /><br />
		<button onclick="submit();">اتمام الاتفاق</button>

		<?php
		}
		else
		{
		?>
		يمكنك رؤيه العملية <a href="dashboard.php">بالصفحة الرئيسية</a>

		<?php
		}
		?>

	</div>
</div>
</body>
</html>
<script type="text/javascript">
	function window_close()
	{
		close();
		return false;
	}
	function submit()
	{
		window.location = <?php echo "\"confirm2.php?id=" . $_GET["id"] ."&id2=" . $_GET["id2"] . "&request_id=" . $_GET["request_id"] . "&name2=" . $_GET["name"] . "&phone2=" . $_GET["phone"] . "&notes=" . $_GET["notes"] . "\"" ?> + "&name=" + document.getElementById("name").value + "&phone=" + document.getElementById("phone").value; 
	}


</script>
