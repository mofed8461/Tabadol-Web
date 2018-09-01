<?php
session_start();
include "connect.php";

// confirm_request.php?id=2&id2=1&request_id=1&name=mmm&phone=55

if (isset($_GET["id"]))
{
	$query2 = $con->query("SELECT * FROM requests WHERE id=" . $_GET['request_id']);
	$result2 = $query2->fetch_assoc();

	if ($result2 == NULL || $result2["req_code"] == "completed")
	{
		header("Location: invitation_ended.php");
	}

 	$query = $con->query("SELECT * FROM schools WHERE id=" . $_GET['id']);
	$result = $query->fetch_assoc();

	$query2 = $con->query("SELECT * FROM schools WHERE id=" . $_GET['id2']);
	$result2 = $query2->fetch_assoc();

	$msg = "
			<html>
			<head>
			<title>HTML email</title>
			</head>
			<body>
				<a href='confirm2.php?id=" . $_GET["id"] . "&id2=" . $$_GET["id2"] . "&request_id=" . $_GET["request_id"] . "&name=" . $_GET["name"] . "&phone=" . $_GET["phone"] . "&notes=" . $_GET["notes"] . "'>لقد قبلت مدرسة " . $result2["name"] . " دعوتكم اضغط هنا للموافقة</a>
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



	header("Location: confirm_request.php");
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
		شكرا لقبولكم الدعوة سيتم ارسال تأكيد<br />
		<a href="javascript:window.open('','_self').close();">اغلاق</a>
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


</script>
