<?php
session_start();

$school_id  = $_POST["id"];



include("connect.php");

$msg = "";
if (isset($_POST["reset"]))
{
	$con->query("UPDATE users SET password=username WHERE school_id=$school_id");
	$msg = "تم استعاده كلمه المرور و هي الان نفس اسم المستخدم";
}
else
{

	$pw  = $_POST["password"];
	$pw1 = $_POST["password_1"];
	$pw2 = $_POST["password_2"];

	$hasData = $con->query("SELECT password FROM users WHERE school_id=$school_id AND password='$pw'");

	if ($hasData != NULL)
	{
		$hasData = $hasData->fetch_assoc();
	}

	$success = 1;
	$msg = "تم التعديل";
	if ($pw1 != $pw2)
	{
		$msg = "كلمتا المرور غير متوافقتين";
		$success = 0;
	}
	else if ($hasData == NULL)
	{
		$msg = "كلمه المرور القديمه غير صحصه";
		$success = 0;
	}



	if ($success == 1)
	{
		$con->query("UPDATE users SET password='$pw2' WHERE school_id=$school_id") or die("Error in inserting data");
	}
}

echo "<h2 align='center'>" . $msg . "</h2>";

?>
<script language="javascript">
    setTimeout("window.location='dashboard.php'",'3000');
</script>
