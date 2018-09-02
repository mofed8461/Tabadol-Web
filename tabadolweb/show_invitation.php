<?php
session_start();
include "connect.php";

//show_invitation.php?id=" . $_GET["id"] . "&id2=" . $result["id"] . "&request_id=" . $_GET["request_id"] . "
//id=2&id2=1&request_id=1
if (isset($_GET['id']) && isset($_GET['id2']) && isset($_GET['request_id']))
{
	$query = $con->query("SELECT * FROM schools WHERE id=" . $_GET['id']);
	$result = $query->fetch_assoc();
	
	$query2 = $con->query("SELECT * FROM requests WHERE id=" . $_GET['request_id']);
	$result2 = $query2->fetch_assoc();

	if ($result2 == NULL || $result2["req_code"] == "completed")
	{
		header("Location: invitation_ended.php");
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
		مدرسه <a href="view_school_info.php?id=<?php echo $_GET["id"]; ?>"><?php echo $result["name"]; ?></a> تطلب من حضرتكم استقراض من تاريخ <?php echo $result2["start_time"]; ?> الى تاريخ <?php echo $result2["end_time"]; ?> و ذلك بالمطاليب التالية
		<br />
		<table border="1px">
			<tr>
				<th>اسم الجهاز</th>
				<th>الكمية</th>
			</tr>
			<?php
				$query3 = $con->query("
					SELECT 
                        request_data.id AS id,
                        dev_types.name AS name, 
                        request_data.quantity AS quantity
                        FROM schools, dev_types, request_data, requests
                    WHERE 
                        requests.id=request_data.request_id AND
                        schools.id=requests.school_id AND 
                        request_data.dev_type_id=dev_types.id AND 
                        schools.id=" . $_GET['id'] . " AND
                        request_data.request_id=" . $_GET['request_id']);

				while ($result3 = $query3->fetch_assoc())
				{
					?>
					<tr>
						<td><?php echo $result3["name"]; ?></td>
						<td><?php echo $result3["quantity"]; ?></td>
					</tr>
					<?php
				}

			?>
		</table>
		الاسم<input id="name" type="text" /><br />
		رقم الهاتف<input id="phone" type="text" /><br />
		ملاحظات<input id="notes" type="text" /><br />
		<a href="javascript:window.open('','_self').close();">اعتذر عن الاقراض</a> او <a href="javascript:submit();">موافق على الاقراض</a>

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
		window.location = "<?php echo "confirm_request.php?id=" . $_GET["id"] . "&id2=" . $_GET["id2"] . "&request_id=" . $_GET["request_id"]; ?>&name=" + document.getElementById("name").value + "&phone=" + document.getElementById("phone").value + "&notes=" + document.getElementById("notes").value;
	}
</script>
	<?php


}
else
{
    header('Location: dashboard.php');
}
?>
